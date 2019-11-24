<?php

declare(strict_types=1);

/**
 * RepositoryTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3\Infrastructure\Repository;

use D3\Domain\Model\ValueObject\Uuid;
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
     * @covers ::__construct
     * @covers ::generateId
     *
     * @return void
     */
    public function testGenerateId(): void
    {
        $repository = new Repository();
        $id = $repository->generateId();

        $this->assertInstanceOf(Uuid::class, $id);
    }

    /**
     * @covers ::__construct
     * @covers ::generateId
     *
     * @return void
     */
    public function testGenerateIdReturnsUniqueIds(): void
    {
        $repository = new Repository();
        $id1 = $repository->generateId();
        $id2 = $repository->generateId();

        $this->assertFalse($id1->isEqualTo($id2));
    }
}

