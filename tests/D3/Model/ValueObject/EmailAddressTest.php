<?php

declare(strict_types=1);

/**
 * EmailAddressTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3\Model\ValueObject;

use D3\Model\ValueObject\EmailAddress;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailAddressTest
 *
 * @coversDefaultClass \D3\Model\ValueObject\EmailAddress
 * @covers \D3\Model\ValueObject\AbstractValueObject
 */
class EmailAddressTest extends TestCase
{
    /**
     * @covers ::isValidValue
     *
     * @testWith [null, false]
     *           ["", false]
     *           ["john.doe@example.com", true]
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

        $emailAddress = new EmailAddress($value);

        if ($valid) {
            $this->assertSame($value, $emailAddress->getValue());
        }
    }
}

