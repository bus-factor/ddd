<?php

declare(strict_types=1);

/**
 * ComparableTrait.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3;

/**
 * Trait ComparableTrait
 */
trait ComparableTrait
{
    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isEqualTo(
        ComparableInterface $subject
    ): bool {
        return $this->compareTo($subject) == 0;
    }

    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isGreaterThan(
        ComparableInterface $subject
    ): bool {
        return $this->compareTo($subject) > 0;
    }

    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isGreaterThanOrEqualTo(
        ComparableInterface $subject
    ): bool {
        return $this->compareTo($subject) >= 0;
    }

    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isLessThan(
        ComparableInterface $subject
    ): bool {
        return $this->compareTo($subject) < 0;
    }

    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isLessThanOrEqualTo(
        ComparableInterface $subject
    ): bool {
        return $this->compareTo($subject) <= 0;
    }

    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isNotEqualTo(
        ComparableInterface $subject
    ): bool {
        return $this->compareTo($subject) != 0;
    }
}
