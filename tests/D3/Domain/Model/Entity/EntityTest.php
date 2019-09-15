<?php

declare(strict_types=1);

/**
 * EntityTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3\Domain\Model\Entity;

use D3\Domain\Model\Entity\Entity;
use D3\Domain\Model\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

/**
 * Class EntityTest
 *
 * @coversDefaultClass \D3\Domain\Model\Entity\Entity
 */
class EntityTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getId
     *
     * @return void
     */
    public function testConstructor(): void
    {
        $id = new Uuid('c4a760a8-dbcf-5254-a0d9-6a4474bd1b62');
        $entity = new Entity($id);

        $this->assertSame($id, $entity->getId());
    }
}

