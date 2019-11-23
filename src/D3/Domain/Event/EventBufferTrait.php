<?php

/**
 * EventBufferTrait.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-11-23
 */

declare(strict_types=1);

namespace D3\Domain\Event;

/**
 * Trait EventBufferTrait
 */
trait EventBufferTrait
{
    /** @var Event[] $events */
    private $events = [];

    /**
     * @return Event|null
     */
    public function dequeueEvent(): ?Event
    {
        return empty($this->events) ? null : array_shift($this->events);
    }

    /**
     * @param Event $event
     * @return void
     */
    public function enqueueEvent(Event $event): void
    {
        $this->events[] = $event;
    }
}
