<?php

/**
 * PhpType.php
 *
 * Author: Michael Leßnau <michael.lessnau@gmail.com>
 * Date:   2020-12-27
 */

declare(strict_types=1);

namespace BusFactor\Ddd\ValueObject;

/**
 * Class PhpType
 */
class PhpType extends Enum
{
    public const NULL = 'NULL';
    public const ARRAY = 'array';
    public const BOOLEAN = 'boolean';
    public const DOUBLE = 'double';
    public const INTEGER = 'integer';
    public const OBJECT = 'object';
    public const RESOURCE_CLOSED = 'resource (closed)';
    public const RESOURCE = 'resource';
    public const STRING = 'string';
    public const UNKNOWN_TYPE = 'unknown type';
}
