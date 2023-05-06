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
 *
 * @deprecated Consider using PHP 8.1 enumerations instead.
 */
class Enum extends SingleValueObject
{
    private static array $constants = [];

    private static array $instances = [];

    protected function __construct(mixed $value)
    {
        parent::__construct($value);
    }

    /**
     * @throws InvalidArgumentException If the provided enum name does not exist.
     */
    public static function __callStatic(string $name, array $arguments): static
    {
        $constants = static::getValidValues();

        if (! array_key_exists($name, $constants)) {
            throw new InvalidArgumentException('Invalid enumeration name: ' . $name);
        }

        if (! isset(self::$instances[static::class][$name])) {
            $instance = new static($constants[$name]);
            self::$instances[static::class][$name] = $instance;
        }

        return self::$instances[static::class][$name];
    }

    public static function getValidValues(): array
    {
        if (!isset(self::$constants[static::class])) {
            $class = new ReflectionClass(static::class);
            self::$constants[static::class] = $class->getConstants();
        }

        return self::$constants[static::class];
    }

    public static function isValidValue(mixed $value): bool
    {
        return in_array($value, static::getValidValues(), true);
    }

    public static function parse(mixed $value): static
    {
        $constants = static::getValidValues();
        $name = array_search($value, $constants, true);

        if ($name === false) {
            throw new InvalidArgumentException('Invalid enumeration value: ' . $value);
        }

        if (!isset(self::$instances[static::class][$name])) {
            $instance = new static($constants[$name]);
            self::$instances[static::class][$name] = $instance;
        }

        return self::$instances[static::class][$name];
    }
}
