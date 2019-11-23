<?php

/**
 * EventBufferTraitTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-11-23
 */

declare(strict_types=1);

namespace Test\D3\Domain\Event;

use D3\Domain\Event\{Event, EventBufferTrait};
use PHPUnit\Framework\TestCase;

/**
 * Class EventBufferTraitTest
 *
 * @coversDefaultClass \D3\Domain\Event\EventBufferTrait
 */
class EventBufferTraitTest extends TestCase
{
    /**
     * @covers ::enqueueEvent
     * @covers ::dequeueEvent
     *
     * @return void
     */
    public function testEventQueueing(): void
    {
        $eventBuffer = $this
            ->getMockBuilder(EventBufferTrait::class)
            ->getMockForTrait();

        $fooEvent = new Event('foo');
        $barEvent = new Event('bar');

        $eventBuffer->enqueueEvent($fooEvent);
        $eventBuffer->enqueueEvent($barEvent);

        $this->assertSame($fooEvent, $eventBuffer->dequeueEvent());
        $this->assertSame($barEvent, $eventBuffer->dequeueEvent());
        $this->assertNull($eventBuffer->dequeueEvent());
    }
}
