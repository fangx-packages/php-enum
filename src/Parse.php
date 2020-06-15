<?php
declare(strict_types=1);

namespace Fangx\Enum;

use ReflectionClass;

class Parse
{
    public static function enum(string $class)
    {
        foreach ((new ReflectionClass($class))->getConstants() as $constant => $value) {
            if (substr($constant, 0, 2) === '__') {
                continue;
            }

            yield new ConstantDefinition($class, $constant, '__' . $constant);
        }
    }
}
