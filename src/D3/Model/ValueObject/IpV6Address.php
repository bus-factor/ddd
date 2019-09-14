<?php

declare(strict_types=1);

/**
 * IpV6Address.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace D3\Model\ValueObject;

/**
 * Class IpV6Address
 */
class IpV6Address extends AbstractValueObject
{
    /**
     * @param string $value Value.
     * @return bool
     */
    public static function isValidValue($value): bool
    {
        return is_string($value) && filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }
}

