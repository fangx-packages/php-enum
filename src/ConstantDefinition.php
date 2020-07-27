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
