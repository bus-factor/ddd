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

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param mixed $value Value.
     */
    public function __construct($value)
    {
        if (!static::isValidValue($value)) {
            throw new InvalidArgumentException(
                'Invalid value provided'
            );
        }

        $this->value = $value;
    }

    /**
     * @param ComparableInterface $subject Subject.
     * @return int
     * @throws LogicException If class types mismatch.
     */
    public function compareTo(ComparableInterface $subject): int
    {
        if (static::class !== get_class($subject)) {
            throw new LogicException(
                'Cannot compare incompatible types'
            );
        }

        return $this->value <=> $subject->getValue();
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function getArrayValue(): array
    {
        return $this->value;
    }

    /**
     * @return float
     */
    public function getFloatValue(): float
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getIntegerValue(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getStringValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value Value.
     * @return bool
     */
    public static function isValidValue(
        $value
    ): bool {
        return false;
    }
}
