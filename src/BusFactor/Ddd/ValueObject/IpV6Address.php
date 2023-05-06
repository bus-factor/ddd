<?php

declare(strict_types=1);

/**
 * IpV6Address.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace BusFactor\Ddd\ValueObject;

/**
 * Class IpV6Address
 */
class IpV6Address extends IpAddress
{
    public static function isValidValue(mixed $value): bool
    {
        return is_string($value)
            && filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }

    public function isIpV4Address(): bool
    {
        return false;
    }

    public function isIpV6Address(): bool
    {
        return true;
    }
}
