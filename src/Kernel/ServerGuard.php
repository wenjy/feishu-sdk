<?php

namespace FeiShu\Kernel;

use Exception;
use FeiShu\Kernel\Contracts\MessageInterface;
use FeiShu\Kernel\Exceptions\BadRequestException;
use FeiShu\Kernel\Exceptions\InvalidArgumentException;
use FeiShu\Kernel\Exceptions\InvalidConfigException;
use FeiShu\Kernel\Messages\Message;
use FeiShu\Kernel\Messages\Text;
use FeiShu\Kernel\Support\Collection;
use FeiShu\Kernel\Support\XML;
use FeiShu\Kernel\Traits\Observable;
use FeiShu\Kernel\Traits\ResponseCastable;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ServerGuard.
 */
class ServerGuard
{
    use Observable;
    use ResponseCastable;

    /**
     * @var bool
     */
    protected $alwaysValidate = false;

    /**
     * Empty string.
     */
    public const SUCCESS_EMPTY_RESPONSE = 'success';

    /**
     * @var array
     */
    public const MESSAGE_TYPE_MAPPING = [
        'text' => Message::TEXT,
    ];

    /**
     * @var ServiceContainer
     */
    protected $app;

    /**
     * Constructor.
     *
     * @codeCoverageIgnore
     *
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * Handle and return response.
     *
     * @return Response
     *
     * @throws BadRequestException
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     */
    public function serve(): Response
    {
        $this->app['logger']->debug('Request received:', [
            'method'       => $this->app['request']->getMethod(),
            'uri'          => $this->app['request']->getUri(),
            'content-type' => $this->app['request']->getContentType(),
            'content'      => $this->app['request']->getContent(),
        ]);

        $response = $this->validate()->resolve();

        $this->app['logger']->debug('Server response created:', ['content' => $response->getContent()]);

        return $response;
    }

    /**
     * @return $this
     *
     * @throws BadRequestException
     */
    public function validate()
    {
        if (!$this->alwaysValidate && !$this->isSafeMode()) {
            return $this;
        }

        if ($this->app['request']->get('signature') !== $this->signature([
                $this->getToken(),
                $this->app['request']->get('timestamp'),
                $this->app['request']->get('nonce'),
            ])) {
            throw new BadRequestException('Invalid request signature.', 400);
        }

        return $this;
    }

    /**
     * Force validate request.
     *
     * @return $this
     */
    public function forceValidate()
    {
        $this->alwaysValidate = true;

        return $this;
    }

    /**
     * Get request message.
     *
     * @return array|Collection|object|string
     *
     * @throws BadRequestException
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     */
    public function getMessage()
    {
        $message = $this->parseMessage($this->app['request']->getContent(false));

        if (!is_array($message) || empty($message)) {
            throw new BadRequestException('No message received.');
        }

        if ($this->isSafeMode() && !empty($message['Encrypt'])) {
            $message = $this->decryptMessage($message);

            // Handle JSON format.
            $dataSet = json_decode($message, true);

            if ($dataSet && (JSON_ERROR_NONE === json_last_error())) {
                return $dataSet;
            }

            $message = XML::parse($message);
        }

        return $this->detectAndCastResponseToType($message, $this->app->config->get('response_type'));
    }

    /**
     * Resolve server request and return the response.
     *
     * @return Response
     *
     * @throws BadRequestException
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     */
    protected function resolve(): Response
    {
        $result = $this->handleRequest();

        if ($this->shouldReturnRawResponse()) {
            $response = new Response($result['response']);
        } else {
            $response = new Response(
                $this->buildResponse($result['to'], $result['from'], $result['response']),
                200,
                ['Content-Type' => 'application/xml']
            );
        }

        $this->app->events->dispatch(new Events\ServerGuardResponseCreated($response));

        return $response;
    }

    /**
     * @return string|null
     */
    protected function getToken()
    {
        return $this->app['config']['token'];
    }

    /**
     * @param string $to
     * @param string $from
     * @param MessageInterface|string|int $message
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public function buildResponse(string $to, string $from, $message)
    {
        if (empty($message) || self::SUCCESS_EMPTY_RESPONSE === $message) {
            return self::SUCCESS_EMPTY_RESPONSE;
        }

        if (is_string($message) || is_numeric($message)) {
            $message = new Text((string)$message);
        }

        if (!($message instanceof Message)) {
            throw new InvalidArgumentException(sprintf('Invalid Messages type "%s".', gettype($message)));
        }

        return $this->buildReply($to, $from, $message);
    }

    /**
     * Handle request.
     *
     * @return array
     *
     * @throws BadRequestException
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     */
    protected function handleRequest(): array
    {
        $castedMessage = $this->getMessage();

        $messageArray = $this->detectAndCastResponseToType($castedMessage, 'array');

        $response = $this->dispatch(self::MESSAGE_TYPE_MAPPING[$messageArray['MsgType'] ?? $messageArray['msg_type'] ?? 'text'],
            $castedMessage);

        return [
            'to'       => $messageArray['FromUserName'] ?? '',
            'from'     => $messageArray['ToUserName'] ?? '',
            'response' => $response,
        ];
    }

    /**
     * Build reply XML.
     *
     * @param string $to
     * @param string $from
     * @param MessageInterface $message
     *
     * @return string
     */
    protected function buildReply(string $to, string $from, MessageInterface $message): string
    {
        $prepends = [
            'ToUserName'   => $to,
            'FromUserName' => $from,
            'CreateTime'   => time(),
            'MsgType'      => $message->getType(),
        ];

        $response = $message->transformToXml($prepends);

        if ($this->isSafeMode()) {
            $this->app['logger']->debug('Messages safe mode is enabled.');
            $response = $this->app['encryptor']->encrypt($response);
        }

        return $response;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    protected function signature(array $params)
    {
        sort($params, SORT_STRING);

        return sha1(implode($params));
    }

    /**
     * Parse message array from raw php input.
     *
     * @param string $content
     *
     * @return array
     *
     * @throws BadRequestException
     */
    protected function parseMessage($content)
    {
        try {
            if (0 === stripos($content, '<')) {
                $content = XML::parse($content);
            } else {
                // Handle JSON format.
                $dataSet = json_decode($content, true);
                if ($dataSet && (JSON_ERROR_NONE === json_last_error())) {
                    $content = $dataSet;
                }
            }

            return (array)$content;
        } catch (Exception $e) {
            throw new BadRequestException(sprintf('Invalid message content:(%s) %s', $e->getCode(), $e->getMessage()),
                $e->getCode());
        }
    }

    /**
     * Check the request message safe mode.
     *
     * @return bool
     */
    protected function isSafeMode(): bool
    {
        return $this->app['request']->get('signature') && 'aes' === $this->app['request']->get('encrypt_type');
    }

    /**
     * @return bool
     */
    protected function shouldReturnRawResponse(): bool
    {
        return false;
    }

    /**
     * @param array $message
     *
     * @return mixed
     */
    protected function decryptMessage(array $message)
    {
        return $message = $this->app['encryptor']->decrypt(
            $message['Encrypt'],
            $this->app['request']->get('msg_signature'),
            $this->app['request']->get('nonce'),
            $this->app['request']->get('timestamp')
        );
    }
}
