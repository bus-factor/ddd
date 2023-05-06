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
    public function getValue(): mixed;

    public function getArrayValue(): array;

    public function getFloatValue(): float;

    public function getIntegerValue(): int;

    public function getStringValue(): string;

    public static function isValidValue($value): bool;
}
