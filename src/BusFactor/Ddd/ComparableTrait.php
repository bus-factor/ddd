<?php

declare(strict_types=1);

/**
 * ComparableTrait.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace BusFactor\Ddd;

/**
 * Trait ComparableTrait
 */
trait ComparableTrait
{
    public function isEqualTo(ComparableInterface $subject): bool
    {
        return $this->compareTo($subject) == 0;
    }

    public function isGreaterThan(ComparableInterface $subject): bool
    {
        return $this->compareTo($subject) > 0;
    }

    public function isGreaterThanOrEqualTo(ComparableInterface $subject): bool
    {
        return $this->compareTo($subject) >= 0;
    }

    public function isLessThan(ComparableInterface $subject): bool
    {
        return $this->compareTo($subject) < 0;
    }

    public function isLessThanOrEqualTo(ComparableInterface $subject): bool
    {
        return $this->compareTo($subject) <= 0;
    }

    public function isNotEqualTo(ComparableInterface $subject): bool
    {
        return $this->compareTo($subject) != 0;
    }
}
