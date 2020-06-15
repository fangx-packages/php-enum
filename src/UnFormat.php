<?php
declare(strict_types=1);

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
