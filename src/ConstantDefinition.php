<?php
declare(strict_types=1);

namespace Fangx\Enum;

use Fangx\Enum\Contracts\Definition;

class ConstantDefinition implements Definition
{
    protected $class;
    protected $keyConstant;
    protected $valueConstant;

    public function __construct($class, $keyConstant, $valueConstant)
    {
        $this->class = $class;
        $this->keyConstant = $keyConstant;
        $this->valueConstant = $valueConstant;
    }

    public function getKey()
    {
        return constant($this->class . '::' . $this->keyConstant);
    }

    public function getValue()
    {
        return constant($this->class . '::' . $this->valueConstant);
    }
}
