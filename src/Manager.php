<?php
declare(strict_types=1);

namespace Fangx\Enum;

use Fangx\Enum\Contracts\Definition;
use Fangx\Enum\Contracts\Filter;
use Fangx\Enum\Contracts\Format;

class Manager
{
    protected $class;

    public function __construct(string $class)
    {
        $this->class = $class;
    }

    public function get(?Format $format = null, ?Filter $filter = null): Enum
    {
        $enums = (new $this->class)->all() ?: Parse::enum($this->class);
        $format = $format ?: new UnFormat();

        $return = new Enum();

        foreach ($enums as $enum) {
            if ($filter) {
                if (call_user_func($filter, $enum)) {
                    $return->offsetSet(null, $format->parse($enum));
                }
            } else {
                $return->offsetSet(null, $format->parse($enum));
            }
        }

        return $return;
    }

    public function toArray(?Format $format = null, ?Filter $filter = null)
    {
        return $this->get($format, $filter)->toArray();
    }

    public function toJson(?Format $format = null, ?Filter $filter = null)
    {
        return $this->get($format, $filter)->toJson();
    }

    public function desc($key, $default = 'Undefined')
    {
        return $this->isValidKey($key) ? $this->toArray()[$key] : $default;
    }

    public function isValidKey($key)
    {
        return array_key_exists($key, $this->toArray());
    }
}
