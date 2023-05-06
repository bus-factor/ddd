<?php

declare(strict_types=1);

/**
 * ComparableInterface.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace BusFactor\Ddd;

/**
 * Interface ComparableInterface
 */
interface ComparableInterface
{
    public function compareTo(ComparableInterface $subject): int;

    public function isEqualTo(ComparableInterface $subject): bool;

    public function isGreaterThan(ComparableInterface $subject): bool;

    public function isGreaterThanOrEqualTo(ComparableInterface $subject): bool;

    public function isLessThan(ComparableInterface $subject): bool;

    public function isLessThanOrEqualTo(ComparableInterface $subject): bool;

    public function isNotEqualTo(ComparableInterface $subject): bool;
}
