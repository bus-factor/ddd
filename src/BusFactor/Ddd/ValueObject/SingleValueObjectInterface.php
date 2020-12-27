<?php

declare(strict_types=1);

/**
 * SingleValueObjectInterface.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace BusFactor\Ddd\ValueObject;

use BusFactor\Ddd\ComparableInterface;

/**
 * Interface SingleValueObjectInterface
 */
interface SingleValueObjectInterface extends ComparableInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return float
     */
    public function getFloatValue(): float;

    /**
     * @return int
     */
    public function getIntegerValue(): int;

    /**
     * @return string
     */
    public function getStringValue(): string;

    /**
     * @param mixed $value Value.
     * @return bool
     */
    public static function isValidValue(
        $value
    ): bool;
}
