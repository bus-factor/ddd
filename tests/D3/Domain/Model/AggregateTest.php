<?php

/**
 * AggregateTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-11-23
 */

declare(strict_types=1);

namespace Test\D3\Domain\Model\Aggregate;

use PHPUnit\Framework\TestCase;
use D3\Domain\Model\Aggregate\Aggregate;

/**
 * Class AggregateTest
 */
class AggregateTest extends TestCase
{
    /**
     * @testWith ["D3\\Domain\\Event\\EventBufferInterface"]
     *           ["D3\\Domain\\Model\\Aggregate\\AggregateInterface"]
     *
     * @return void
     */
    public function testInstanceOf(string $fqcn): void
    {
        $aggregate = new Aggregate();

        $this->assertInstanceOf($fqcn, $aggregate);
    }
}

