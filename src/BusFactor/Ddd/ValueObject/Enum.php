<?php

declare(strict_types=1);

/**
 * Enum.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace BusFactor\Ddd\ValueObject;

use InvalidArgumentException;
use ReflectionClass;

/**
 * Class Enum
 */
class Enum extends SingleValueObject
{
    /**
     * @var array
     */
    private static $constants = [];

    /**
     * @var array
     */
    private static $instances = [];

    /**
     * @param mixed $value
     */
    protected function __construct(
        $value
    ) {
        parent::__construct($value);
    }

    /**
     * @param string $name      Constant name.
     * @param array  $arguments Arguments.
     * @return mixed
     * @throws InvalidArgumentException If the provided enum name does not exist.
     */
    public static function __callStatic(
        string $name,
        array $arguments
    ): self {
        $constants = static::getValidValues();

        if (!array_key_exists($name, $constants)) {
            throw new InvalidArgumentException(
                'Invalid enumeration name: ' . $name
            );
        }

        if (!isset(self::$instances[static::class][$name])) {
            $instance = new static($constants[$name]);
            self::$instances[static::class][$name] = $instance;
        }

        return self::$instances[static::class][$name];
    }

    /**
     * @return array
     */
    public static function getValidValues(): array
    {
        if (!isset(self::$constants[static::class])) {
            $class = new ReflectionClass(static::class);
            self::$constants[static::class] = $class->getConstants();
        }

        return self::$constants[static::class];
    }

    /**
     * @param mixed $value Value.
     * @return bool
     */
    public static function isValidValue(
        $value
    ): bool {
        return in_array($value, static::getValidValues(), true);
    }

    /**
     * @param mixed $value
     * @return static
     */
    public static function parse(
        $value
    ) {
        $constants = static::getValidValues();
        $name = array_search($value, $constants, true);

        if ($name === false) {
            throw new InvalidArgumentException(
                'Invalid enumeration value: ' . $value
            );
        }

        if (!isset(self::$instances[static::class][$name])) {
            $instance = new static($constants[$name]);
            self::$instances[static::class][$name] = $instance;
        }

        return self::$instances[static::class][$name];
    }
}
