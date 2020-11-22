<?php

/**
 * Collection.php
 *
 * Author: Michael Leßnau <michael.lessnau@gmail.com>
 * Date:   2020-11-22
 */

declare(strict_types=1);

namespace D3\Collection;

use ArrayObject;
use DomainException;

/**
 * Class Collection
 */
class Collection extends ArrayObject
{
    private const PRIMITIVE_TYPES = [
        'NULL',
        'array',
        'boolean',
        'double',
        'integer',
        'object',
        'resource (closed)',
        'resource',
        'string',
        'unknown type',
    ];

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

        $this->valueTypeIsPrimitive = in_array(
            $valueType,
            self::PRIMITIVE_TYPES,
            true
        );

        $this->exchangeArray($values);
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function append($value)
    {
        $this->enforceConstraints($value);
        parent::append($value);
    }

    /**
     * @param mixed $values
     * @return array
     */
    public function exchangeArray($values)
    {
        foreach ($values as $value) {
            $this->enforceConstraints($value);
        }

        return parent::exchangeArray($values);
    }

    /**
     * @param mixed $index
     * @param mixed $newValue
     * @return void
     */
    public function offsetSet($index, $newValue)
    {
        $this->enforceConstraints($newValue);
        parent::offsetSet($index, $newValue);
    }

    /**
     * @return void
     */
    protected function freeze(): void
    {
        $this->frozen = true;
    }

    /**
     * @param mixed $value
     * @return void
     */
    private function enforceConstraints($value): void
    {
        if ($this->frozen) {
            throw new DomainException(
                'Cannot modify immutable object'
            );
        }

        if ($this->valueTypeIsPrimitive) {
            $valueType = gettype($value);

            if ($valueType !== $this->valueType) {
                throw new DomainException(
                    sprintf(
                        'Expected value type [%s], got [%s]',
                        $this->valueType,
                        $valueType
                    )
                );
            }
        } elseif (!$value instanceof $this->valueType) {
            throw new DomainException(
                sprintf(
                    'Expected value type [%s], got [%s]',
                    $this->valueType,
                    get_class($value)
                )
            );
        }
    }
}
