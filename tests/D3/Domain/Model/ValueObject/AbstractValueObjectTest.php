<?php

declare(strict_types=1);

/**
 * AbstractValueObjectTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3\Domain\Model\ValueObject;

use D3\Domain\Model\ValueObject\AbstractValueObject;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractValueObjectTest
 *
 * @coversDefaultClass \D3\Domain\Model\ValueObject\AbstractValueObject
 */
class AbstractValueObjectTest extends TestCase
{
    /**
     * @covers ::__construct
     *
     * @return void
     */
    public function testConstructor(): void
    {
        $this->markTestSkipped('To do');
    }

    /**
     * @covers ::compareTo
     *
     * @return void
     */
    public function testCompareTo(): void
    {
        $this->markTestSkipped('To do');
    }

    /**
     * @covers ::getValue
     *
     * @return void
     */
    public function testGetValue(): void
    {
        $this->markTestSkipped('To do');
    }
}

