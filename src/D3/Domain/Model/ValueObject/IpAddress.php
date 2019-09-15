<?php

declare(strict_types=1);

/**
 * IpAddress.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace D3\Domain\Model\ValueObject;

/**
 * Class IpAddress
 */
class IpAddress extends AbstractValueObject
{
    /**
     * @param string $value Value.
     * @return bool
     */
    public static function isValidValue($value): bool
    {
        return is_string($value) && filter_var($value, FILTER_VALIDATE_IP) !== false;
    }

    /**
     * @return bool
     */
    public function isIpV4Address(): bool
    {
        return filter_var($this->getValue(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }

    /**
     * @return bool
     */
    public function isIpV6Address(): bool
    {
        return filter_var($this->getValue(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }
}

