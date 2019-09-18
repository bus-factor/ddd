<?php

declare(strict_types=1);

/**
 * ValueObjectTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3\Domain\Model\ValueObject;

use D3\Domain\Model\ValueObject\ValueObject;
use D3\Domain\Model\ValueObject\ValueObjectInterface;
use LogicException;
use PHPUnit\Framework\TestCase;

/**
 * Class ValueObjectTest
 *
 * @coversDefaultClass \D3\Domain\Model\ValueObject\ValueObject
 */
class ValueObjectTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getValue
     *
     * @testWith ["abc"]
     *           ["xyz", "LogicException", "Invalid value provided"]
     *
     * @param string      $value                    Value.
     * @param string|null $expectedException        Expected exception FQCN.
     * @param string|null $expectedExceptionMessage Expected exception message.
     * @return void
     */
    public function testConstructor(
        string $value,
        ?string $expectedException = null,
        ?string $expectedExceptionMessage = null
    ): void {
        if ($expectedException !== null) {
            $this->expectException($expectedException);
            $this->expectExceptionMessage($expectedExceptionMessage);
        }

        $valueObject = new class($value) extends ValueObject {
            public static function isValidValue($value): bool {
                return $value === 'abc';
            }
        };

        if ($expectedException === null) {
            $this->assertSame($value, $valueObject->getValue());
        }
    }

    /**
     * @covers ::compareTo
     *
     * @dataProvider provideCompareToData
     *
     * @param ValueObjectInterface $valueObject1        Value object #1.
     * @param ValueObjectInterface $valueObject2        Value object #2.
     * @param int             $retVal                   Return value.
     * @param string|null     $expectedException        Expected exception FQCN.
     * @param string|null     $expectedExceptionMessage Expected exception message.
     * @return void
     */
    public function testCompareTo(
        ValueObjectInterface $valueObject1,
        ValueObjectInterface $valueObject2,
        int $retVal,
        ?string $expectedException = null,
        ?string $expectedExceptionMessage = null
    ): void {
        if ($expectedException !== null) {
            $this->expectException($expectedException);
            $this->expectExceptionMessage($expectedExceptionMessage);

            $valueObject1->compareTo($valueObject2);
        } else {
            $this->assertSame($retVal, $valueObject1->compareTo($valueObject2));
        }
    }

    /**
     * @return array
     */
    public function provideCompareToData(): array
    {
        $fqcn = get_class(new class('abc') extends ValueObject {
            public static function isValidValue($value): bool {
                return true;
            }
        });

        return [
            'a > b' => [
                new $fqcn(2),
                new $fqcn(1),
                1,
            ],
            'a < b' => [
                new $fqcn(1),
                new $fqcn(2),
                -1,
            ],
            'a == b' => [
                new $fqcn(1),
                new $fqcn(1),
                0,
            ],
            'a incompatible b' => [
                new class('abc') extends ValueObject {
                    public static function isValidValue($value): bool {
                        return true;
                    }
                },
                new class('abc') extends ValueObject {
                    public static function isValidValue($value): bool {
                        return true;
                    }
                },
                0,
                LogicException::class,
                'Cannot compare incompatible types',
            ],
        ];
    }

    /**
     * @covers ::isValidValue
     *
     * @return void
     */
    public function testIsValidValue(): void
    {
        $this->assertFalse(ValueObject::isValidValue(1337));
    }
}

