<?php

declare(strict_types=1);

/**
 * Uuid.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-15
 */

namespace D3\Domain\Model\ValueObject;

use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid as UuidGenerator;

/**
 * Class Uuid
 */
class Uuid extends ValueObject implements UuidInterface
{
    /**
     * @return static
     * @throws UnsatisfiedDependencyException In case of issues with the current OS/platform.
     */
    public static function generate()
    {
        return new static(UuidGenerator::uuid4()->toString());
    }

    /**
     * @param string $value Value.
     * @return bool
     */
    public static function isValidValue($value): bool
    {
        return is_string($value)
            && preg_match('/^[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}$/', $value) === 1;
    }
}

