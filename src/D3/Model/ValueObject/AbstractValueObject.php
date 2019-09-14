<?php

declare(strict_types=1);

/**
 * AbstractValueObject.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3\Model\ValueObject;

use InvalidArgumentException;

/**
 * Class AbstractValueObject
 */
abstract class AbstractValueObject implements ValueObjectInterface
{
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
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}

