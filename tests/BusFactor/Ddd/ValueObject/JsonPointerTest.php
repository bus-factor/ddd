<?php

/**
 * JsonPointerTest.php
 *
 * Author: Michael Leßnau <michael.lessnau@gmail.com>
 * Date:   2020-12-27
 */

declare(strict_types=1);

namespace Test\BusFactor\Ddd\ValueObject;

use BusFactor\Ddd\ValueObject\JsonPointer;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class JsonPointerTest
 *
 * @covers \BusFactor\Ddd\ValueObject\JsonPointer
 */
class JsonPointerTest extends TestCase
{
    /**
     * @testWith [["", "data", "attributes", "firstName"], "/data/attributes/firstName"]
     *           [[""], ""]
     *           [["", "data", "relationships", "posts", 42], "/data/relationships/posts/42"]
     *
     * @param array $value
     * @param string $stringValue
     * @return void
     */
    public function testConstruct(array $value, string $stringValue): void
    {
        $subject = new JsonPointer($value);

        $this->assertEquals($stringValue, $subject->getStringValue());
        $this->assertEquals($value, JsonPointer::parse($stringValue)->getArrayValue());
        $this->assertEquals($value, $subject->getArrayValue());
    }

    /**
     * @return void
     */
    public function testStackOperations(): void
    {
        $subject = new JsonPointer(['', 'data']);

        $otherSubject = $subject->pushReference('attributes');

        $this->assertNotSame($subject, $otherSubject);
        $this->assertEquals(['', 'data'], $subject->getArrayValue());
        $this->assertEquals(['', 'data', 'attributes'], $otherSubject->getArrayValue());

        $otherSubject2 = $otherSubject->popReference();

        $this->assertNotSame($otherSubject, $otherSubject2);
        $this->assertEquals(['', 'data'], $otherSubject2->getArrayValue());
        $this->assertEquals(['', 'data', 'attributes'], $otherSubject->getArrayValue());
    }
}
