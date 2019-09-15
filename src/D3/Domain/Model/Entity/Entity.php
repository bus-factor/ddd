<?php

declare(strict_types=1);

/**
 * Entity.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3\Domain\Model\Entity;

use D3\Domain\Model\ComparableInterface;
use D3\Domain\Model\ComparableTrait;
use D3\Domain\Model\ValueObject\Uuid;
use LogicException;

/**
 * Class Entity
 */
class Entity implements EntityInterface
{
    use ComparableTrait;

    /** @var Uuid $id */
    private $id;

    /**
     * @param Uuid $id Identifier.
     */
    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    /**
     * @param ComparableInterface $subject Subject.
     * @return int
     * @throws LogicException If class types mismatch.
     */
    public function compareTo(ComparableInterface $subject): int
    {
        if (static::class !== get_class($subject)) {
            throw new LogicException('Cannot compare incompatible types');
        }

        return $this->id->compareTo($subject->getId());
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }
}

