<?php

namespace FeiShu\Kernel\Clauses;

/**
 * Class Clause.
 */
class Clause
{
    /**
     * @var array
     */
    protected $clauses = [
        'where' => [],
    ];

    /**
     * @param mixed ...$args
     *
     * @return $this
     */
    public function where(...$args)
    {
        array_push($this->clauses['where'], $args);

        return $this;
    }

    /**
     * @param mixed $payload
     *
     * @return bool
     */
    public function intercepted($payload)
    {
        return $this->interceptWhereClause($payload);
    }

    /**
     * @param mixed $payload
     *
     * @return bool
     */
    protected function interceptWhereClause($payload): bool
    {
        foreach ($this->clauses['where'] as $item) {
            list($key, $value) = $item;

            if (!isset($payload[$key])) {
                continue;
            }

            if (is_array($value) && !in_array($payload[$key], $value)) {
                return true;
            }

            if (!is_array($value) && $payload[$key] !== $value) {
                return true;
            }
        }

        return false;
    }
}
