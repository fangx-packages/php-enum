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

namespace Fangx\Enum\Concerns;

use Fangx\Enum\Contracts\Filter;
use Fangx\Enum\Contracts\Format;
use Fangx\Enum\Enum;
use Fangx\Enum\Manager;

/**
 * Trait Enumable.
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
trait Enumable
{
    public static function __callStatic($method, $args)
    {
        return static::resolve()->{$method}(...$args);
    }

    public function __call($method, $args)
    {
        return static::resolve($this)->{$method}(...$args);
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

    final public static function resolve(object $class = null): Manager
    {
        return new Manager($class ?: new static());
    }
}
