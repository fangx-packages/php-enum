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
use Fangx\Enum\Contracts\Format;

class UnFormat implements Format
{
    public function parse(Definition $definition): array
    {
        return [$definition->getKey() => $definition->getValue()];
    }
}
