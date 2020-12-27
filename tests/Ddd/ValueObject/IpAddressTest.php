<?php

declare(strict_types=1);

/**
 * IpAddressTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\Ddd\ValueObject;

use Ddd\ValueObject\IpAddress;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class IpAddressTest
 *
 * @coversDefaultClass \Ddd\ValueObject\IpAddress
 * @covers \Ddd\ValueObject\SingleValueObject
 */
class IpAddressTest extends TestCase
{
    /**
     * @covers ::isValidValue
     *
     * @testWith [null, false]
     *           ["", false]
     *           ["192.168.0.1", true]
     *           ["2001:0db8:85a3:0000:0000:8a2e:0370:7334", true]
     *
     * @param mixed $value Value.
     * @param bool  $valid Indicates if the provided value is valid.
     * @return void
     */
    public function testConstructor($value, bool $valid): void
    {
        if (!$valid) {
            $this->expectException(InvalidArgumentException::class);
            $this->expectExceptionMessage('Invalid value provided');
        }

        $ipAddress = new IpAddress($value);

        if ($valid) {
            $this->assertSame($value, $ipAddress->getValue());
        }
    }

    /**
     * @covers ::isIpV4Address
     *
     * @testWith ["192.168.0.1", true]
     *           ["2001:0db8:85a3:0000:0000:8a2e:0370:7334", false]
     *
     * @param mixed $value  Value.
     * @param bool  $isIpV4 Indicates if the provided value is IPv4.
     * @return void
     */
    public function testIsIpV4Address($value, bool $isIpV4): void
    {
        $ipAddress = new IpAddress($value);

        $this->assertSame($isIpV4, $ipAddress->isIpV4Address());
    }

    /**
     * @covers ::isIpV6Address
     *
     * @testWith ["192.168.0.1", false]
     *           ["2001:0db8:85a3:0000:0000:8a2e:0370:7334", true]
     *
     * @param mixed $value  Value.
     * @param bool  $isIpV6 Indicates if the provided value is IPv6.
     * @return void
     */
    public function testIsIpV6Address($value, bool $isIpV6): void
    {
        $ipAddress = new IpAddress($value);

        $this->assertSame($isIpV6, $ipAddress->isIpV6Address());
    }
}
