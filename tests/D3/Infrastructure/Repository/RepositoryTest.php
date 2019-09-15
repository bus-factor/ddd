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
     * @covers ::generateId
     *
     * @return void
     */
    public function testGenerateId(): void
    {
        $id = Repository::generateId();

        $this->assertInstanceOf(Uuid::class, $id);
    }

    /**
     * @covers ::generateId
     *
     * @return void
     */
    public function testGenerateIdReturnsUniqueIds(): void
    {
        $id1 = Repository::generateId();
        $id2 = Repository::generateId();

        $this->assertFalse($id1->isEqualTo($id2));
    }
}

