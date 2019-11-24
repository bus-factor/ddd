<?php

declare(strict_types=1);

/**
 * Repository.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3\Infrastructure\Repository;

use D3\Domain\Model\ValueObject\{Uuid, UuidInterface};
use D3\Domain\Repository\RepositoryInterface;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid as UuidGenerator;

/**
 * Class Repository
 */
class Repository implements RepositoryInterface
{
    /** @var string $uuidFqcn */
    private $uuidFqcn;

    /**
     * @param string|null $uuidFqcn
     */
    public function __construct(string $uuidFqcn = null)
    {
        $this->uuidFqcn = $uuidFqcn ?? Uuid::class;
    }

    /**
     * @return UuidInterface
     * @throws UnsatisfiedDependencyException In case of issues with the current OS/platform.
     */
    public function generateId(): UuidInterface
    {
        return new $this->uuidFqcn(UuidGenerator::uuid4()->toString());
    }
}

