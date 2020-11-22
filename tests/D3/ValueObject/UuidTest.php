<?php

declare(strict_types=1);

/**
 * UuidTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3\ValueObject;

use D3\ValueObject\Uuid;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class UuidTest
 *
 * @coversDefaultClass \D3\ValueObject\Uuid
 * @covers \D3\ValueObject\ValueObject
 */
class UuidTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::generate
     *
     * @return void
     */
    public function testGenerateId(): void
    {
        $this->assertInstanceOf(Uuid::class, Uuid::generate());
    }

    /**
     * @covers ::__construct
     * @covers ::generate
     *
     * @return void
     */
    public function testGenerateIdReturnsUniqueIds(): void
    {
        $id1 = Uuid::generate();
        $id2 = Uuid::generate();

        $this->assertFalse($id1->isEqualTo($id2));
    }

    /**
     * @covers ::isValidValue
     *
     * @testWith [null, false]
     *           ["", false]
     *           ["c4a760a8-dbcf-5254-a0d9-6a4474bd1b62", true]
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

        $uuid = new Uuid($value);

        if ($valid) {
            $this->assertSame($value, $uuid->getValue());
        }
    }
}

