<?php

declare(strict_types=1);

/**
 * EnumTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace Test\D3\ValueObject;

use D3\ValueObject\Enum;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EnumTestDummy extends Enum
{
    public const FOO = 'foo';
    public const BAR = 'bar';
    public const BUZZ = 'buzz';
}

/**
 * Class EnumTest
 *
 * @coversDefaultClass \D3\ValueObject\Enum
 * @covers \D3\ValueObject\ValueObject
 */
class EnumTest extends TestCase
{
    /**
     * @covers ::__callStatic
     * @covers ::__construct
     * @covers ::getValidValues
     *
     * @return void
     */
    public function testCallStatic(): void
    {
        $this->assertSame(EnumTestDummy::BAR(), EnumTestDummy::BAR());
    }

    /**
     * @covers ::__construct
     * @covers ::__callStatic
     * @covers ::getValidValues
     *
     * @return void
     */
    public function testCallStaticWithInvalidName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid enumeration name: FIZZ');

        EnumTestDummy::FIZZ();
    }

    /**
     * @covers ::getValidValues
     *
     * @return void
     */
    public function testGetValidValues(): void
    {
        $expected = ['FOO' => 'foo', 'BAR' => 'bar', 'BUZZ' => 'buzz'];
        $actual = EnumTestDummy::getValidValues();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers ::__callStatic
     * @covers ::__construct
     * @covers ::getValidValues
     * @covers ::getValue
     *
     * @return void
     */
    public function testGetValue(): void
    {
        $this->assertSame('foo', EnumTestDummy::FOO()->getValue());
        $this->assertSame('bar', EnumTestDummy::BAR()->getValue());
    }

    /**
     * @covers ::getValidValues
     * @covers ::isValidValue
     *
     * @testWith ["foo", true]
     *           ["bar", true]
     *           ["FOO", false]
     *
     * @param string $value Value.
     * @param bool   $valid Indicates if the enum value is valid.
     * @return void
     */
    public function testIsValidValue(string $value, bool $valid): void
    {
        $this->assertSame($valid, EnumTestDummy::isValidValue($value));
    }

    /**
     * @covers ::__construct
     * @covers ::getValidValues
     * @covers ::parse
     *
     * @return void
     */
    public function testParse(): void
    {
        $this->assertSame(EnumTestDummy::parse('buzz'), EnumTestDummy::parse('buzz'));
    }

    /**
     * @covers ::__construct
     * @covers ::getValidValues
     * @covers ::parse
     *
     * @return void
     */
    public function testParseWithInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid enumeration value: fizz');

        EnumTestDummy::parse('fizz');
    }
}

