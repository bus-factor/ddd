<?php

/**
 * ImmutableCollection.php
 *
 * Author: Michael Leßnau <michael.lessnau@gmail.com>
 * Date:   2020-11-22
 */

declare(strict_types=1);

namespace BusFactor\Ddd\Collection;

/**
 * Class ImmutableCollection
 */
class ImmutableCollection extends Collection
{
    /**
     * @param string $valueType
     * @param array $values
     * @param int $flags
     * @param string $iteratorClass
     */
    public function __construct(
        string $valueType,
        array $values = [],
        int $flags = 0,
        string $iteratorClass = 'ArrayIterator'
    ) {
        parent::__construct($valueType, $values, $flags, $iteratorClass);
        $this->freeze();
    }
}
