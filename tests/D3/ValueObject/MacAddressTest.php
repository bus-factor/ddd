<?php

declare(strict_types=1);

/**
 * MacAddressTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3\ValueObject;

use D3\ValueObject\MacAddress;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class MacAddressTest
 *
 * @coversDefaultClass \D3\ValueObject\MacAddress
 * @covers \D3\ValueObject\ValueObject
 */
class MacAddressTest extends TestCase
{
    /**
     * @covers ::isValidValue
     *
     * @testWith [null, false]
     *           ["", false]
     *           ["192.168.0.1", false]
     *           ["2001:0db8:85a3:0000:0000:8a2e:0370:7334", false]
     *           ["01-23-45-67-89-AB", true]
     *           ["01:23:45:67:89:AB", true]
     *           ["0123.4567.89AB", true]
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

        $macAddress = new MacAddress($value);

        if ($valid) {
            $this->assertSame($value, $macAddress->getValue());
        }
    }
}

