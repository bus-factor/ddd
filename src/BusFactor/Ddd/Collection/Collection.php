<?php

/**
 * Collection.php
 *
 * Author: Michael Leßnau <michael.lessnau@gmail.com>
 * Date:   2020-11-22
 */

declare(strict_types=1);

namespace BusFactor\Ddd\Collection;

use ArrayIterator;
use ArrayObject;
use BusFactor\Ddd\ValueObject\PhpType;
use DomainException;
use InvalidArgumentException;

/**
 * Class Collection
 */
class Collection extends ArrayObject
{
    private bool $valueTypeIsPrimitive;

    private bool $frozen = false;

    public function __construct(
        private readonly string $valueType,
        array $values = [],
        int $flags = 0,
        string $iteratorClass = ArrayIterator::class,
    ) {
        parent::__construct([], $flags, $iteratorClass);

        $this->valueTypeIsPrimitive = in_array($valueType, PhpType::getValidValues(), true);

        $this->exchangeArray($values);
    }

    public function append(mixed $value): void
    {
        $this->enforceConstraints(null, $value);
        parent::append($value);
    }

    /**
     * @throws DomainException
     * @throws InvalidArgumentException
     */
    public function exchangeArray(mixed $values): array
    {
        if (! is_array($values)) {
            throw new InvalidArgumentException('Expected array, got ' . gettype($values));
        }

        foreach ($values as $offset => $value) {
            $this->enforceConstraints($offset, $value);
        }

        return parent::exchangeArray($values);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->enforceConstraints($offset, $value);

        parent::offsetSet($offset, $value);
    }

    protected function freeze(): void
    {
        $this->frozen = true;
    }

    protected function isValidOffsetFormat(mixed $offset): bool
    {
        return true;
    }

    private function enforceConstraints(int|string|null $offset, mixed $value): void
    {
        if ($this->frozen) {
            throw new DomainException('Cannot modify immutable object');
        }

        if (!$this->isValidOffsetFormat($offset)) {
            throw new DomainException('Invalid offset format: ' . $offset);
        }

        if ($this->valueTypeIsPrimitive) {
            $valueType = gettype($value);

            if ($valueType !== $this->valueType) {
                throw new DomainException(
                    sprintf('Expected value type [%s], got [%s]', $this->valueType, $valueType)
                );
            }
        } elseif (!$value instanceof $this->valueType) {
            $valueType = gettype($value) === PhpType::OBJECT ? get_class($value) : gettype($value);

            throw new DomainException(
                sprintf('Expected value type [%s], got [%s]', $this->valueType, $valueType)
            );
        }
    }
}
