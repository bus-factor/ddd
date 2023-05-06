<?php

/**
 * JsonPointer.php
 *
 * Author: Michael Leßnau <michael.lessnau@gmail.com>
 * Date:   2020-12-27
 */

declare(strict_types=1);

namespace BusFactor\Ddd\ValueObject;

use InvalidArgumentException;
use LogicException;

/**
 * Class JsonPointer
 */
class JsonPointer extends SingleValueObject
{
    public function __toString(): string
    {
        return $this->getStringValue();
    }

    public function getStringValue(): string
    {
        $encodedReferences = [];

        foreach ($this->getArrayValue() as $reference) {
            $encodedReferences[] = str_replace(['~', '/'], ['~0', '~1'], (string) $reference);
        }

        return implode('/', $encodedReferences);
    }

    public static function isValidValue(mixed $value): bool
    {
        return is_array($value) && !empty($value);
    }

    public static function parse(string $value): JsonPointer
    {
        $references = [];
        $encodedReferences = explode('/', $value);

        foreach ($encodedReferences as $encodedReference) {
            $references[] = str_replace(['~1', '~0'], ['/', '~'], $encodedReference);
        }

        return new self($references);
    }

    /**
     * @throws LogicException
     */
    public function popReference(): JsonPointer
    {
        $references = $this->getArrayValue();

        array_pop($references);

        return new self($references);
    }

    public function pushReference(string|int $reference): JsonPointer
    {
        return new self([...$this->getArrayValue(), $reference]);
    }
}
