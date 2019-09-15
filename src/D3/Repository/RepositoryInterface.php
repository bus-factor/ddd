<?php

declare(strict_types=1);

/**
 * RepositoryInterface.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3\Repository;

use D3\Model\ValueObject\Uuid;

/**
 * Interface RepositoryInterface
 */
interface RepositoryInterface
{
    /**
     * @return Uuid
     */
    public static function generateId(): Uuid;
}

