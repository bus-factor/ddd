<?php

declare(strict_types=1);

/**
 * IpV4AddressTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3\Model\ValueObject;

use D3\Model\ValueObject\IpV4Address;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class IpV4AddressTest
 *
 * @coversDefaultClass \D3\Model\ValueObject\IpV4Address
 * @covers \D3\Model\ValueObject\AbstractValueObject
 */
class IpV4AddressTest extends TestCase
{
    /**
     * @covers ::isValidValue
     *
     * @testWith [null, false]
     *           ["", false]
     *           ["192.168.0.1", true]
     *           ["2001:0db8:85a3:0000:0000:8a2e:0370:7334", false]
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

        $ipV4Address = new IpV4Address($value);

        if ($valid) {
            $this->assertSame($value, $ipV4Address->getValue());
        }
    }

    /**
     * @covers ::isIpV4Address
     *
     * @return void
     */
    public function testIsIpV4Address(): void
    {
        $ipV4Address = new IpV4Address('192.168.0.1');

        $this->assertTrue($ipV4Address->isIpV4Address());
    }

    /**
     * @covers ::isIpV6Address
     *
     * @return void
     */
    public function testIsIpV6Address(): void
    {
        $ipV4Address = new IpV4Address('192.168.0.1');

        $this->assertFalse($ipV4Address->isIpV6Address());
    }
}

