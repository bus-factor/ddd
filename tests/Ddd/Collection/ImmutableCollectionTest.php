<?php

/**
 * ImmutableCollectionTest.php
 *
 * Author: Michael Leßnau <michael.lessnau@gmail.com>
 * Date:   2020-12-27
 */

declare(strict_types=1);

namespace Ddd\Collection;

use Ddd\ValueObject\PhpType;
use DomainException;
use PHPUnit\Framework\TestCase;

/**
 * Class ImmutableCollectionTest
 *
 * @covers \Ddd\Collection\ImmutableCollection
 */
class ImmutableCollectionTest extends TestCase
{
    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $items = [1, 2, 3];
        $subject = new ImmutableCollection(PhpType::INTEGER, $items);

        $this->assertInstanceOf(Collection::class, $subject);
        $this->assertEquals($items, $subject->getArrayCopy());
    }

    /**
     * @return void
     */
    public function testAppendFailure(): void
    {
        $items = [1, 2, 3];
        $subject = new ImmutableCollection(PhpType::INTEGER, $items);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Cannot modify immutable object');

        $subject->append(3);
    }

    /**
     * @return void
     */
    public function testExchangeArrayFailure(): void
    {
        $items = [1, 2, 3];
        $subject = new ImmutableCollection(PhpType::INTEGER, $items);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Cannot modify immutable object');

        $subject->exchangeArray([4, 5, 6]);
    }

    /**
     * @return void
     */
    public function testOffsetSetFailure(): void
    {
        $items = [1, 2, 3];
        $subject = new ImmutableCollection(PhpType::INTEGER, $items);

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Cannot modify immutable object');

        $subject[5] = 6;
    }
}
