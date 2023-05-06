<?php

/**
 * ImmutableCollection.php
 *
 * Author: Michael Leßnau <michael.lessnau@gmail.com>
 * Date:   2020-11-22
 */

declare(strict_types=1);

namespace BusFactor\Ddd\Collection;

use ArrayIterator;

/**
 * Class ImmutableCollection
 */
class ImmutableCollection extends Collection
{
    public function __construct(
        string $valueType,
        array $values = [],
        int $flags = 0,
        string $iteratorClass = ArrayIterator::class,
    ) {
        parent::__construct($valueType, $values, $flags, $iteratorClass);

        $this->freeze();
    }
}
