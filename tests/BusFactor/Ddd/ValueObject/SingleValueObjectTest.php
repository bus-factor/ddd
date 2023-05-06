<?php

declare(strict_types=1);

/**
 * SingleValueObjectTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\BusFactor\Ddd\ValueObject;

use BusFactor\Ddd\ValueObject\SingleValueObject;
use BusFactor\Ddd\ValueObject\SingleValueObjectInterface;
use LogicException;
use PHPUnit\Framework\TestCase;

/**
 * Class SingleValueObjectTest
 *
 * @coversDefaultClass \BusFactor\Ddd\ValueObject\SingleValueObject
 */
class SingleValueObjectTest extends TestCase
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

        $valueObject = new class($value) extends SingleValueObject {
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
     * @param SingleValueObjectInterface $valueObject1        Value object #1.
     * @param SingleValueObjectInterface $valueObject2        Value object #2.
     * @param int             $retVal                   Return value.
     * @param string|null     $expectedException        Expected exception FQCN.
     * @param string|null     $expectedExceptionMessage Expected exception message.
     * @return void
     */
    public function testCompareTo(
        SingleValueObjectInterface $valueObject1,
        SingleValueObjectInterface $valueObject2,
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
    public static function provideCompareToData(): array
    {
        $fqcn = get_class(new class('abc') extends SingleValueObject {
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
                new class('abc') extends SingleValueObject {
                    public static function isValidValue($value): bool {
                        return true;
                    }
                },
                new class('abc') extends SingleValueObject {
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
        $this->assertFalse(SingleValueObject::isValidValue(1337));
    }

    /**
     * @covers ::getArrayValue
     *
     * @return void
     */
    public function testGetArrayValue(): void
    {
        $value = [1, 2, 3];

        $subject = new class($value) extends SingleValueObject {
            public function __construct($value) {
                parent::__construct($value);
            }

            public static function isValidValue($value): bool {
                return true;
            }
        };

        $this->assertEquals($value, $subject->getArrayValue());
    }

    /**
     * @covers ::getFloatValue
     *
     * @return void
     */
    public function testGetFloatValue(): void
    {
        $value = 13.37;

        $subject = new class($value) extends SingleValueObject {
            public function __construct($value) {
                parent::__construct($value);
            }

            public static function isValidValue($value): bool {
                return true;
            }
        };

        $this->assertSame($value, $subject->getFloatValue());
    }

    /**
     * @covers ::getIntegerValue
     *
     * @return void
     */
    public function testGetIntegerValue(): void
    {
        $value = 42;

        $subject = new class($value) extends SingleValueObject {
            public function __construct($value) {
                parent::__construct($value);
            }

            public static function isValidValue($value): bool {
                return true;
            }
        };

        $this->assertSame($value, $subject->getIntegerValue());
    }

    /**
     * @covers ::getStringValue
     *
     * @return void
     */
    public function testGetStringValue(): void
    {
        $value = 'foo';

        $subject = new class($value) extends SingleValueObject {
            public function __construct($value) {
                parent::__construct($value);
            }

            public static function isValidValue($value): bool {
                return true;
            }
        };

        $this->assertSame($value, $subject->getStringValue());
    }
}
