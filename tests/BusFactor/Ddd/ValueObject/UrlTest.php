<?php

declare(strict_types=1);

/**
 * UrlTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\BusFactor\Ddd\ValueObject;

use BusFactor\Ddd\ValueObject\Url;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class UrlTest
 *
 * @coversDefaultClass \BusFactor\Ddd\ValueObject\Url
 * @covers \BusFactor\Ddd\ValueObject\SingleValueObject
 */
class UrlTest extends TestCase
{
    /**
     * @covers ::isValidValue
     *
     * @testWith [null, false]
     *           ["", false]
     *           ["http://www.example.com", true]
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

        $url = new Url($value);

        if ($valid) {
            $this->assertSame($value, $url->getValue());
        }
    }
}
