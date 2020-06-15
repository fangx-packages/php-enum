<?php
declare(strict_types=1);

namespace Fangx\Enum;

use Fangx\Enum\Contracts\Filter;
use Fangx\Enum\Contracts\Format;

/**
 * Class AbstractEnum
 * @package Fangx\Manager
 *
 * @method static Enum get(?Format $format = null, ?Filter $filter = null)
 * @method static toArray(?Format $format = null, ?Filter $filter = null)
 * @method static toJson(?Format $format = null, ?Filter $filter = null)
 * @method static desc($key, $default = 'Undefined')
 *
 * @see Manager
 * @see Enum
 */
abstract class AbstractEnum
{
    public static function __callStatic($method, $args)
    {
        return static::resolve()->$method(...$args);
    }

    private static function resolve(): Manager
    {
        return new Manager(static::class);
    }

    public function all()
    {
        return null;
    }
}
