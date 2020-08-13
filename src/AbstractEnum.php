<?php

declare(strict_types=1);

/**
 * Fangx's Packages
 *
 * @link     https://github.com/fangx-packages/php-enum
 * @document https://github.com/fangx-packages/php-enum/blob/master/README.md
 * @contact  nfangxu@gmail.com
 * @author   nfangxu
 */

namespace Fangx\Enum;

use Fangx\Enum\Contracts\Filter;
use Fangx\Enum\Contracts\Format;

/**
 * Class AbstractEnum.
 *
 * @method static Enum get(?Format $format = null, Filter ...$filters)
 * @method static Manager addFilter(\Closure|Filter $filter)
 * @method static Manager setFormat(Format $format)
 * @method static array toArray(?Format $format = null, Filter ...$filters)
 * @method static string toJson(?Format $format = null, Filter ...$filters)
 * @method static mixed desc($key, $default = 'Undefined')
 *
 * @see Manager
 * @see Enum
 */
abstract class AbstractEnum
{
    public static function __callStatic($method, $args)
    {
        return static::resolve()->{$method}(...$args);
    }

    public function all()
    {
        return null;
    }

    /**
     * The filters if not $filters.
     *
     * @return array
     */
    public function filters()
    {
        return [];
    }

    /**
     * The format if not $format.
     */
    public function format(): ?Format
    {
        return null;
    }

    private static function resolve(): Manager
    {
        return new Manager(static::class);
    }
}
