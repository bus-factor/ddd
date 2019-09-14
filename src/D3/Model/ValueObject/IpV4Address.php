<?php

declare(strict_types=1);

/**
 * IpV4Address.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace D3\Model\ValueObject;

/**
 * Class IpV4Address
 */
class IpV4Address extends IpAddress
{
    /**
     * @param string $value Value.
     * @return bool
     */
    public static function isValidValue($value): bool
    {
        return is_string($value) && filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }

    /**
     * @return bool
     */
    public function isIpV4Address(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isIpV6Address(): bool
    {
        return false;
    }
}

