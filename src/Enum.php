<?php

declare(strict_types=1);

/**
 * Fangx's Packages
 *
 * @link     https://github.com/fangx-packages/hyperf-resource
 * @document https://github.com/fangx-packages/hyperf-resource/blob/master/README.md
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

    public function __toString()
    {
        return $this->toJson(JSON_UNESCAPED_UNICODE);
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
            $enum = array_merge($enum, $item);
        }

        return $enum;
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
