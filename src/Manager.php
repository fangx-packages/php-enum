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

class Manager
{
    protected $class;

    public function __construct(string $class)
    {
        $this->class = $class;
    }

    /**
     * Get all.
     *
     * @param Filter[] $filters
     */
    public function get(?Format $format = null, ...$filters): Enum
    {
        /** @var AbstractEnum $class */
        $class = (new $this->class());

        $defaultFormat = $class->format() ?: new UnFormat();

        $enums = $class->all() ?: Parse::enum($this->class);
        $format = $format ?: $defaultFormat;
        $filters = $filters ?: $class->filters();

        $return = new Enum();

        foreach ($enums as $enum) {
            $filteredOut = false;

            if ($filters) {
                foreach ($filters as $filter) {
                    if (call_user_func($filter, $enum)) {
                        $filteredOut = true;
                        break;
                    }
                }
            }

            if (! $filteredOut) {
                $return->offsetSet(null, $format->parse($enum));
            }
        }

        return $return;
    }

    /**
     * Get all as array.
     *
     * @param Filter[] $filters
     * @return array
     */
    public function toArray(?Format $format = null, ...$filters)
    {
        return $this->get($format, ...$filters)->toArray();
    }

    /**
     * Get all as json.
     *
     * @param Filter[] $filters
     * @return false|string
     */
    public function toJson(?Format $format = null, ...$filters)
    {
        return $this->get($format, ...$filters)->toJson();
    }

    /**
     * Get description for enum.
     *
     * @param int|string $key
     * @param mixed $default
     * @return mixed|string
     */
    public function desc($key, $default = 'Undefined')
    {
        return $this->isValidKey($key) ? $this->toArray()[$key] : $default;
    }

    /**
     * The enum key is valid.
     *
     * @param int|string $key
     * @return bool
     */
    public function isValidKey($key)
    {
        return array_key_exists($key, $this->toArray());
    }
}
