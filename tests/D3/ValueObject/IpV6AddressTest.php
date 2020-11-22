<?php

declare(strict_types=1);

/**
 * IpV6AddressTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3\ValueObject;

use D3\ValueObject\IpV6Address;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class IpV6AddressTest
 *
 * @coversDefaultClass \D3\ValueObject\IpV6Address
 * @covers \D3\ValueObject\ValueObject
 */
class IpV6AddressTest extends TestCase
{
    /**
     * @covers ::isValidValue
     *
     * @testWith [null, false]
     *           ["", false]
     *           ["192.168.0.1", false]
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

        $ipV6Address = new IpV6Address($value);

        if ($valid) {
            $this->assertSame($value, $ipV6Address->getValue());
        }
    }

    /**
     * @covers ::isIpV4Address
     *
     * @return void
     */
    public function testIsIpV4Address(): void
    {
        $ipV6Address = new IpV6Address('2001:0db8:85a3:0000:0000:8a2e:0370:7334');

        $this->assertFalse($ipV6Address->isIpV4Address());
    }

    /**
     * @covers ::isIpV6Address
     *
     * @return void
     */
    public function testIsIpV6Address(): void
    {
        $ipV6Address = new IpV6Address('2001:0db8:85a3:0000:0000:8a2e:0370:7334');

        $this->assertTrue($ipV6Address->isIpV6Address());
    }
}

