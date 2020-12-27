<?php

declare(strict_types=1);

/**
 * ComparableInterface.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Ddd;

/**
 * Interface ComparableInterface
 */
interface ComparableInterface
{
    /**
     * @param ComparableInterface $subject Subject.
     * @return int
     */
    public function compareTo(
        ComparableInterface $subject
    ): int;

    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isEqualTo(
        ComparableInterface $subject
    ): bool;

    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isGreaterThan(
        ComparableInterface $subject
    ): bool;

    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isGreaterThanOrEqualTo(
        ComparableInterface $subject
    ): bool;

    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isLessThan(
        ComparableInterface $subject
    ): bool;

    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isLessThanOrEqualTo(
        ComparableInterface $subject
    ): bool;

    /**
     * @param ComparableInterface $subject Subject.
     * @return bool
     */
    public function isNotEqualTo(
        ComparableInterface $subject
    ): bool;
}
