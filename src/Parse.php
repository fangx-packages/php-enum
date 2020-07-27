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
