<?php

declare(strict_types=1);

/**
 * ValueObjectInterface.php
 *
 * @author Michael Leßnau <michael.lessnau@gmail.com>
 * @since  2019-09-14
 */

namespace D3\Model\ValueObject;

/**
 * Interface ValueObjectInterface
 */
interface ValueObjectInterface
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

