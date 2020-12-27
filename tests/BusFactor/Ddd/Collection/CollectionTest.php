<?php

/**
 * CollectionTest.php
 *
 * Author: Michael Leßnau <michael.lessnau@gmail.com>
 * Date:   2020-12-27
 */

declare(strict_types=1);

namespace Test\BusFactor\Ddd\Collection;

use BusFactor\Ddd\Collection\Collection;
use BusFactor\Ddd\ValueObject\PhpType;
use DomainException;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Class CollectionTest
 *
 * @covers \BusFactor\Ddd\Collection\Collection
 */
class CollectionTest extends TestCase
{
    /**
     * @return void
     */
    public function testConstructSuccess(): void
    {
        $items = [1, 2, 3, 4];
        $subject = new Collection(PhpType::INTEGER, $items);

        $this->assertEquals($items, $subject->getArrayCopy());
    }

    /**
     * @return void
     */
    public function testConstructFailureWhenUsingPrimitiveType(): void
    {
        $items = ['a', 'b', 'c'];

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Expected value type [integer], got [string]');

        new Collection(PhpType::INTEGER, $items);
    }

    /**
     * @return void
     */
    public function testConstructFailureWhenUsingComplexType(): void
    {
        $items = ['a', 'b', 'c'];

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Expected value type [stdClass], got [string]');

        new Collection(stdClass::class, $items);
    }

    /**
     * @return void
     */
    public function testAppendSuccess(): void
    {
        $items = [1, 2, 3];
        $subject = new Collection(PhpType::INTEGER, $items);

        $subject->append(4);

        $this->assertEquals([1, 2, 3, 4], $subject->getArrayCopy());
    }

    /**
     * @return void
     */
    public function testAppendFailureWhenUsingPrimitiveType(): void
    {
        $items = [1, 2, 3];
        $subject = new Collection(PhpType::INTEGER, $items);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Expected value type [integer], got [array]');

        $subject->append(['nested', 'array']);
    }

    /**
     * @return void
     */
    public function testFreeze(): void
    {
        $items = [1, 2, 3];
        $subject = new class(PhpType::INTEGER, $items) extends Collection {
            public function __construct(string $valueType, array $values = []) {
                parent::__construct($valueType, $values);
                $this->freeze();
            }
        };

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Cannot modify immutable object');

        $subject->append(4);
    }
}
