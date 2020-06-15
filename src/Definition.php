<?php
declare(strict_types=1);

namespace Fangx\Enum;

class Definition implements Contracts\Definition
{
    protected $key;

    protected $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }
}
