<?php

/**
 * Collection.php
 *
 * Author: Michael Leßnau <michael.lessnau@gmail.com>
 * Date:   2020-11-22
 */

declare(strict_types=1);

namespace BusFactor\Ddd\Collection;

use ArrayObject;
use BusFactor\Ddd\ValueObject\PhpType;
use DomainException;

/**
 * Class Collection
 */
class Collection extends ArrayObject
{
    /**
     * @var string
     */
    private $valueType;

    /**
     * @var bool
     */
    private $valueTypeIsPrimitive;

    /**
     * @var bool
     */
    private $frozen = false;

    /**
     * @param string $valueType
     * @param array $values
     * @param int $flags
     * @param string $iteratorClass
     */
    public function __construct(
        string $valueType,
        array $values = [],
        int $flags = 0,
        string $iteratorClass = 'ArrayIterator'
    ) {
        parent::__construct([], $flags, $iteratorClass);

        $this->valueType = $valueType;
        $this->valueTypeIsPrimitive = in_array($valueType, PhpType::getValidValues(), true);

        $this->exchangeArray($values);
    }

    /**
     * @param mixed $value
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function append($value)
    {
        $this->enforceConstraints(null, $value);
        parent::append($value);
    }

    /**
     * @param mixed|array $values
     * @return array
     * @throws DomainException
     */
    public function exchangeArray($values): array
    {
        foreach ($values as $offset => $value) {
            $this->enforceConstraints($offset, $value);
        }

        return parent::exchangeArray($values);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        $this->enforceConstraints($offset, $value);
        parent::offsetSet($offset, $value);
    }

    /**
     * @return void
     */
    protected function freeze(): void
    {
        $this->frozen = true;
    }

    /**
     * @param int|string|null $offset
     * @return bool
     */
    protected function isValidOffsetFormat($offset): bool
    {
        return true;
    }

    /**
     * @param int|string|null $offset
     * @param mixed $value
     * @return void
     */
    private function enforceConstraints($offset, $value): void
    {
        if ($this->frozen) {
            throw new DomainException(
                'Cannot modify immutable object'
            );
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
