<?php

declare(strict_types=1);

/**
 * Entity.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3\Model\Entity;

use D3\Model\ValueObject\Uuid;

/**
 * Class Entity
 */
class Entity
{
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
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }
}
