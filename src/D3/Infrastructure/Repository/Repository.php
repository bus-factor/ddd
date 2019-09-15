<?php

declare(strict_types=1);

/**
 * Repository.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3\Infrastructure\Repository;

use D3\Domain\Model\ValueObject\Uuid;
use D3\Domain\Repository\RepositoryInterface;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid as UuidGenerator;

/**
 * Class Repository
 */
class Repository implements RepositoryInterface
{
    /**
     * @return Uuid
     * @throws UnsatisfiedDependencyException In case of issues with the current OS/platform.
     */
    public static function generateId(): Uuid
    {
        return new Uuid(UuidGenerator::uuid4()->toString());
    }
}

