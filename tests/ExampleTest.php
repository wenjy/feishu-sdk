<?php

namespace Tests;

use FeiShu\Example;
use PHPUnit\Framework\TestCase;

/**
 * @date: 16:59 2022/2/15
 */
class ExampleTest extends TestCase
{
    public function testAdd()
    {
        $e = new Example();
        $this->assertEquals(3, $e->add(1, 2));
    }
}
