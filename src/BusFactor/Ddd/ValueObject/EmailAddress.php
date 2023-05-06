<?php

declare(strict_types=1);

/**
 * EmailAddress.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace BusFactor\Ddd\ValueObject;

/**
 * Class EmailAddress
 */
class EmailAddress extends SingleValueObject
{
    public static function isValidValue(mixed $value): bool
    {
        return is_string($value)
            && filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
