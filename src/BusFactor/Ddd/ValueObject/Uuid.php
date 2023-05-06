<?php

declare(strict_types=1);

/**
 * Uuid.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace BusFactor\Ddd\ValueObject;

use Ramsey\Uuid\Uuid as UuidGenerator;

/**
 * Class Uuid
 */
class Uuid extends SingleValueObject
{
    public const VALUE_PATTERN = '/^[0-9a-z]{8}(-[0-9a-z]{4}){3}-[0-9a-z]{12}$/';

    public static function generate(): static
    {
        return new static(UuidGenerator::uuid4()->toString());
    }

    public static function isValidValue(mixed $value): bool
    {
        return is_string($value)
            && preg_match(self::VALUE_PATTERN, $value) === 1;
    }
}
