<?php

declare(strict_types=1);

/**
 * EmailAddress.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace D3\ValueObject;

/**
 * Class EmailAddress
 */
class EmailAddress extends ValueObject
{
    /**
     * @param string $value Value.
     * @return bool
     */
    public static function isValidValue(
        $value
    ): bool {
        return is_string($value)
            && filter_var(
                $value,
                FILTER_VALIDATE_EMAIL
            ) !== false;
    }
}
