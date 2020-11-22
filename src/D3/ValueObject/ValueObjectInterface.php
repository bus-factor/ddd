<?php

declare(strict_types=1);

/**
 * ValueObjectInterface.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace D3\ValueObject;

use D3\ComparableInterface;

/**
 * Interface ValueObjectInterface
 */
interface ValueObjectInterface extends ComparableInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value Value.
     * @return bool
     */
    public static function isValidValue($value): bool;
}

