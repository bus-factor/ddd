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
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getStringValue();
    }

    /**
     * @return string
     */
    public function getStringValue(): string
    {
        $references = $this->getArrayValue();
        $encodedReferences = [];

        foreach ($references as $reference) {
            $encodedReferences[] = str_replace(['~', '/'], ['~0', '~1'], (string) $reference);
        }

        return implode('/', $encodedReferences);
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isValidValue($value): bool
    {
        return is_array($value)
            && !empty($value);
    }

    /**
     * @param string $value
     * @return JsonPointer
     */
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
     * @return JsonPointer
     * @throws LogicException
     */
    public function popReference(): JsonPointer
    {
        $references = $this->getArrayValue();

        array_pop($references);

        return new self($references);
    }

    /**
     * @param $reference
     * @return JsonPointer
     * @throws InvalidArgumentException
     */
    public function pushReference($reference): JsonPointer
    {
        if (!is_string($reference) && !is_int($reference)) {
            $format = 'Invalid reference. Expected [string], or [integer], got [%s]';

            throw new InvalidArgumentException(sprintf($format, gettype($reference)));
        }

        return new self(array_merge($this->getArrayValue(), [$reference]));
    }
}
