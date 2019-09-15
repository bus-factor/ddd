<?php

declare(strict_types=1);

/**
 * EntityInterface.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3\Model\Entity;

use D3\Model\ValueObject\Uuid;

/**
 * Interface EntityInterface
 */
interface EntityInterface
{
    /**
     * @return Uuid
     */
    public function getId(): Uuid;
}

