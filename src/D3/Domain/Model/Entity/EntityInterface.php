<?php

declare(strict_types=1);

/**
 * EntityInterface.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3\Domain\Model\Entity;

use D3\Domain\Model\ComparableInterface;
use D3\Domain\Model\ValueObject\Uuid;

/**
 * Interface EntityInterface
 */
interface EntityInterface extends ComparableInterface
{
    /**
     * @return Uuid
     */
    public function getId(): Uuid;
}

