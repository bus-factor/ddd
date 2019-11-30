<?php

declare(strict_types=1);

/**
 * RepositoryTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3\Infrastructure\Repository;

use D3\Domain\Repository\RepositoryInterface;
use D3\Infrastructure\Repository\Repository;
use PHPUnit\Framework\TestCase;

/**
 * Class RepositoryTest
 *
 * @coversDefaultClass \D3\Infrastructure\Repository\Repository
 */
class RepositoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstanceOf(): void
    {
        $repository = new Repository();

        $this->assertInstanceOf(RepositoryInterface::class, $repository);
    }
}

