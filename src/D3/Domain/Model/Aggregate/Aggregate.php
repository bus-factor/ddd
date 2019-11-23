<?php

/**
 * Aggregate.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-11-23
 */

declare(strict_types=1);

namespace D3\Domain\Model\Aggregate;

use D3\Domain\Event\EventBufferTrait;

/**
 * Class Aggregate
 */
class Aggregate implements AggregateInterface
{
    use EventBufferTrait;
}
