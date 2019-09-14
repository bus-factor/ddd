<?php

declare(strict_types=1);

/**
 * Enum.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace D3\Model\ValueObject;

use InvalidArgumentException;
use ReflectionClass;

/**
 * Class Enum
 */
class Enum extends AbstractValueObject
{
    /** @var array $constants */
    private static $constants = [];
    /** @var array $instances */
    private static $instances = [];

    /**
     * Constructor.
     */
    private function __construct($value)
    {
        parent::__construct($value);
    }

    /**
     * @param string $name      Constant name.
     * @param array  $arguments Arguments.
     * @return mixed
     * @throws InvalidArgumentException If the provided enum name does not exist.
     */
    public static function __callStatic(string $name, array $arguments): self
    {
        $constants = static::getValidValues();

        if (!array_key_exists($name, $constants)) {
            throw new InvalidArgumentException('Invalid enumeration name: ' . $name);
        }

        if (!isset(self::$instances[static::class][$name])) {
            self::$instances[static::class][$name] = new static($constants[$name]);
        }

        return self::$instances[static::class][$name];
    }

    /**
     * @return array
     */
    public static function getValidValues(): array
    {
        if (!isset(self::$constants[static::class])) {
            self::$constants[static::class] = (new ReflectionClass(static::class))->getConstants();
        }

        return self::$constants[static::class];
    }

    /**
     * @param mixed $value Value.
     * @return bool
     */
    public static function isValidValue($value): bool
    {
        return in_array($value, static::getValidValues(), true);
    }

    /**
     * @param mixed $value
     * @return self
     */
    public static function parse($value): self
    {
        $constants = static::getValidValues();
        $name = array_search($value, $constants, true);

        if ($name === false) {
            throw new InvalidArgumentException('Invalid enumeration value: ' . $value);
        }

        if (!isset(self::$instances[static::class][$name])) {
            self::$instances[static::class][$name] = new static($constants[$name]);
        }

        return self::$instances[static::class][$name];
    }
}
