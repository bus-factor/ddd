<?php

declare(strict_types=1);

/**
 * ValueObject.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace BusFactor\Ddd\ValueObject;

use BusFactor\Ddd\ComparableInterface;
use BusFactor\Ddd\ComparableTrait;
use InvalidArgumentException;
use LogicException;

/**
 * Class ValueObject
 */
class SingleValueObject implements SingleValueObjectInterface
{
    use ComparableTrait;

    public function __construct(
        private readonly mixed $value
    ) {
        if (! static::isValidValue($this->value)) {
            throw new InvalidArgumentException('Invalid value provided');
        }
    }

    /**
     * @throws LogicException If class types mismatch.
     */
    public function compareTo(ComparableInterface $subject): int
    {
        if (static::class !== get_class($subject)) {
            throw new LogicException('Cannot compare incompatible types');
        }

        return $this->value <=> $subject->getValue();
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function getArrayValue(): array
    {
        return $this->value;
    }

    public function getFloatValue(): float
    {
        return $this->value;
    }

    public function getIntegerValue(): int
    {
        return $this->value;
    }

    public function getStringValue(): string
    {
        return $this->value;
    }

    public static function isValidValue(mixed $value): bool
    {
        return false;
    }
}
