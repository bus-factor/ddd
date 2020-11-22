<?php

declare(strict_types=1);

/**
 * Uuid.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3\ValueObject;

use Ramsey\Uuid\Uuid as UuidGenerator;

/**
 * Class Uuid
 */
class Uuid extends SingleValueObject
{
    public const VALUE_PATTERN = '/^[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}$/';

    /**
     * @return static
     */
    public static function generate()
    {
        $value = UuidGenerator::uuid4()->toString();

        return new static($value);
    }

    /**
     * @param string $value Value.
     * @return bool
     */
    public static function isValidValue(
        $value
    ): bool {
        return is_string($value)
            && preg_match(
                self::VALUE_PATTERN,
                $value
            ) === 1;
    }
}
