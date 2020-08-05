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

use ArrayAccess;
use Countable;
use Fangx\Enum\Concerns\SupportArrayAccess;
use Fangx\Enum\Concerns\SupportCountable;
use Fangx\Enum\Concerns\SupportIteratorAggregate;
use Fangx\Enum\Concerns\SupportJsonSerializable;
use IteratorAggregate;
use JsonSerializable;

class Enum implements ArrayAccess, Countable, IteratorAggregate, JsonSerializable
{
    use SupportArrayAccess;
    use SupportCountable;
    use SupportIteratorAggregate;
    use SupportJsonSerializable;

    public $items = [];

    private $keepKeys;

    public function __construct($keepKeys = false)
    {
        $this->keepKeys = $keepKeys;
    }

    public function __toString()
    {
        return $this->toJson();
    }

    public static function make($items)
    {
        $enum = new static();
        $enum->items = $items;
        return $enum;
    }

    public function toArray()
    {
        $enum = [];

        foreach ($this->items as $item) {
            if ($this->keepKeys) {
                $enum += $item;
            } else {
                $enum = array_merge($enum, $item);
            }
        }

        return $enum;
    }

    public function toJson($options = JSON_UNESCAPED_UNICODE)
    {
        return json_encode($this->toArray(), $options);
    }
}
