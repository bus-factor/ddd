<?php

declare(strict_types=1);

/**
 * ValueObject.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3\Domain\Model\ValueObject;

use D3\Domain\Model\ComparableInterface;
use D3\Domain\Model\ComparableTrait;
use InvalidArgumentException;
use LogicException;

/**
 * Class ValueObject
 */
class ValueObject implements ValueObjectInterface
{
    use ComparableTrait;

    /** @var string $value */
    private $value;

    /**
     * @param mixed $value Value.
     */
    public function __construct($value)
    {
        if (!static::isValidValue($value)) {
            throw new InvalidArgumentException('Invalid value provided');
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
            throw new LogicException('Cannot compare incompatible types');
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
     * @param string $value Value.
     * @return bool
     */
    public static function isValidValue($value): bool
    {
        return false;
    }
}

