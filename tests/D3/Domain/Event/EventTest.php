<?php

declare(strict_types=1);

/**
 * EventTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-17
 */

namespace Test\D3\Domain\Event;

use D3\Domain\Event\Event;
use PHPUnit\Framework\TestCase;

/**
 * Class EventTest
 *
 * @coversDefaultClass \D3\Domain\Event\Event
 */
class EventTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getName
     *
     * @return void
     */
    public function testConstructor(): void
    {
        $name = 'foo.bar';

        $event = new Event($name);

        $this->assertSame($name, $event->getName());
    }
}

