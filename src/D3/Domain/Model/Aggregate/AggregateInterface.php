<?php

/**
 * AggregateInterface.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-11-23
 */

declare(strict_types=1);

namespace D3\Domain\Model\Aggregate;

use D3\Domain\Event\EventBufferInterface;

/**
 * Interface AggregateInterface
 */
interface AggregateInterface extends EventBufferInterface
{
}

