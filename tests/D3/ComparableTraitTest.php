<?php

declare(strict_types=1);

/**
 * ComparableTraitTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3;

use D3\ComparableInterface;
use D3\ComparableTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class ComparableTraitTest
 *
 * @coversDefaultClass \D3\ComparableTrait
 */
class ComparableTraitTest extends TestCase
{
    /**
     * @covers ::isEqualTo
     *
     * @testWith [-1, false]
     *           [0, true]
     *           [1, false]
     *
     * @param int  $compareToRetval compareTo return value.
     * @param bool $retval          Expected return value.
     * @return void
     */
    public function testIsEqualTo(int $compareToRetval, bool $retval): void
    {
        $subject = new class implements ComparableInterface {
            use ComparableTrait;
            public function compareTo(ComparableInterface $subject): int { return 0; }
        };

        $comparable = new class($compareToRetval) implements ComparableInterface {
            use ComparableTrait;
            private $compareToRetval;
            public function __construct($compareToRetval) { $this->compareToRetval = $compareToRetval; }
            public function compareTo(ComparableInterface $subject): int { return $this->compareToRetval; }
        };

        $this->assertSame($retval, $comparable->isEqualTo($subject));
    }

    /**
     * @covers ::isGreaterThan
     *
     * @testWith [-1, false]
     *           [0, false]
     *           [1, true]
     *
     * @param int  $compareToRetval compareTo return value.
     * @param bool $retval          Expected return value.
     * @return void
     */
    public function testIsGreaterThan(int $compareToRetval, bool $retval): void
    {
        $subject = new class implements ComparableInterface {
            use ComparableTrait;
            public function compareTo(ComparableInterface $subject): int { return 0; }
        };

        $comparable = new class($compareToRetval) implements ComparableInterface {
            use ComparableTrait;
            private $compareToRetval;
            public function __construct($compareToRetval) { $this->compareToRetval = $compareToRetval; }
            public function compareTo(ComparableInterface $subject): int { return $this->compareToRetval; }
        };

        $this->assertSame($retval, $comparable->isGreaterThan($subject));
    }

    /**
     * @covers ::isGreaterThanOrEqualTo
     *
     * @testWith [-1, false]
     *           [0, true]
     *           [1, true]
     *
     * @param int  $compareToRetval compareTo return value.
     * @param bool $retval          Expected return value.
     * @return void
     */
    public function testIsGreaterThanOrEqualTo(int $compareToRetval, bool $retval): void
    {
        $subject = new class implements ComparableInterface {
            use ComparableTrait;
            public function compareTo(ComparableInterface $subject): int { return 0; }
        };

        $comparable = new class($compareToRetval) implements ComparableInterface {
            use ComparableTrait;
            private $compareToRetval;
            public function __construct($compareToRetval) { $this->compareToRetval = $compareToRetval; }
            public function compareTo(ComparableInterface $subject): int { return $this->compareToRetval; }
        };

        $this->assertSame($retval, $comparable->isGreaterThanOrEqualTo($subject));
    }

    /**
     * @covers ::isLessThan
     *
     * @testWith [-1, true]
     *           [0, false]
     *           [1, false]
     *
     * @param int  $compareToRetval compareTo return value.
     * @param bool $retval          Expected return value.
     * @return void
     */
    public function testIsLessThan(int $compareToRetval, bool $retval): void
    {
        $subject = new class implements ComparableInterface {
            use ComparableTrait;
            public function compareTo(ComparableInterface $subject): int { return 0; }
        };

        $comparable = new class($compareToRetval) implements ComparableInterface {
            use ComparableTrait;
            private $compareToRetval;
            public function __construct($compareToRetval) { $this->compareToRetval = $compareToRetval; }
            public function compareTo(ComparableInterface $subject): int { return $this->compareToRetval; }
        };

        $this->assertSame($retval, $comparable->isLessThan($subject));
    }

    /**
     * @covers ::isLessThanOrEqualTo
     *
     * @testWith [-1, true]
     *           [0, true]
     *           [1, false]
     *
     * @param int  $compareToRetval compareTo return value.
     * @param bool $retval          Expected return value.
     * @return void
     */
    public function testIsLessThanOrEqualTo(int $compareToRetval, bool $retval): void
    {
        $subject = new class implements ComparableInterface {
            use ComparableTrait;
            public function compareTo(ComparableInterface $subject): int { return 0; }
        };

        $comparable = new class($compareToRetval) implements ComparableInterface {
            use ComparableTrait;
            private $compareToRetval;
            public function __construct($compareToRetval) { $this->compareToRetval = $compareToRetval; }
            public function compareTo(ComparableInterface $subject): int { return $this->compareToRetval; }
        };

        $this->assertSame($retval, $comparable->isLessThanOrEqualTo($subject));
    }

    /**
     * @covers ::isNotEqualTo
     *
     * @testWith [-1, true]
     *           [0, false]
     *           [1, true]
     *
     * @param int  $compareToRetval compareTo return value.
     * @param bool $retval          Expected return value.
     * @return void
     */
    public function testIsNotEqualTo(int $compareToRetval, bool $retval): void
    {
        $subject = new class implements ComparableInterface {
            use ComparableTrait;
            public function compareTo(ComparableInterface $subject): int { return 0; }
        };

        $comparable = new class($compareToRetval) implements ComparableInterface {
            use ComparableTrait;
            private $compareToRetval;
            public function __construct($compareToRetval) { $this->compareToRetval = $compareToRetval; }
            public function compareTo(ComparableInterface $subject): int { return $this->compareToRetval; }
        };

        $this->assertSame($retval, $comparable->isNotEqualTo($subject));
    }
}
