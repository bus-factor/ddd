<?php

/**
 * EventBufferInterface.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-11-23
 */

declare(strict_types=1);

namespace D3\Domain\Event;

/**
 * Interface EventBufferInterface
 */
interface EventBufferInterface
{
    /**
     * @return Event|null
     */
    public function dequeueEvent(): ?Event;

    /**
     * @param Event $event
     * @return void
     */
    public function enqueueEvent(Event $event): void;
}
