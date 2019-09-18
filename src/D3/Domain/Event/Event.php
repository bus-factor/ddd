<?php

declare(strict_types=1);

/**
 * Event.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-16
 */

namespace D3\Domain\Event;

use Symfony\Contracts\EventDispatcher\Event as EventBase;

/**
 * Class Event
 */
class Event extends EventBase
{
    /** @var string $name */
    private $name;

    /**
     * @param string $name Event name.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}

