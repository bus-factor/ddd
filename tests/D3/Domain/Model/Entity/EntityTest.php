<?php

declare(strict_types=1);

/**
 * EntityTest.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace Test\D3\Domain\Model\Entity;

use D3\Domain\Event\Event;
use D3\Domain\Model\Entity\Entity;
use D3\Domain\Model\Entity\EntityInterface;
use D3\Domain\Model\ValueObject\Uuid;
use LogicException;
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

    /**
     * @covers ::compareTo
     *
     * @dataProvider provideCompareToData
     *
     * @param EntityInterface $entity1                  Entity #1.
     * @param EntityInterface $entity2                  Entity #2.
     * @param int             $retVal                   Return value.
     * @param string|null     $expectedException        Expected exception FQCN.
     * @param string|null     $expectedExceptionMessage Expected exception message.
     * @return void
     */
    public function testCompareTo(
        EntityInterface $entity1,
        EntityInterface $entity2,
        int $retVal,
        ?string $expectedException = null,
        ?string $expectedExceptionMessage = null
    ): void {
        if ($expectedException !== null) {
            $this->expectException($expectedException);
            $this->expectExceptionMessage($expectedExceptionMessage);

            $entity1->compareTo($entity2);
        } else {
            $this->assertSame($retVal, $entity1->compareTo($entity2));
        }
    }

    /**
     * @return array
     */
    public function provideCompareToData(): array
    {
        return [
            'a > b' => [
                new Entity(new Uuid('c4a760a8-dbcf-5254-a0d9-6a4474bd1b62')),
                new Entity(new Uuid('abcdefad-0334-db5a-bbbb-53748dbcaadd')),
                1,
            ],
            'a < b' => [
                new Entity(new Uuid('abcdefad-0334-db5a-bbbb-53748dbcaadd')),
                new Entity(new Uuid('c4a760a8-dbcf-5254-a0d9-6a4474bd1b62')),
                -1,
            ],
            'a == b' => [
                new Entity(new Uuid('abcdefad-0334-db5a-bbbb-53748dbcaadd')),
                new Entity(new Uuid('abcdefad-0334-db5a-bbbb-53748dbcaadd')),
                0,
            ],
            'a incompatible b' => [
                new Entity(new Uuid('abcdefad-0334-db5a-bbbb-53748dbcaadd')),
                new class(new Uuid('abcdefad-0334-db5a-bbbb-53748dbcaadd')) extends Entity { },
                0,
                LogicException::class,
                'Cannot compare incompatible types',
            ],
        ];
    }

    /**
     * @covers ::attachEvent
     * @covers ::detachEvents
     *
     * @return void
     */
    public function testEventAccessors(): void
    {
        $entity = new class(new Uuid('c4a760a8-dbcf-5254-a0d9-6a4474bd1b62')) extends Entity {
            public function attachEventPublic(Event $event) {
                $this->attachEvent($event);
            }
        };

        $this->assertEquals([], $entity->detachEvents());

        $events = [
            new Event('foo.bar'),
            new Event('fizz.buzz'),
        ];

        $entity->attachEventPublic($events[0]);
        $entity->attachEventPublic($events[1]);

        $this->assertEquals($events, $entity->detachEvents());
        $this->assertEquals([], $entity->detachEvents());
    }
}

