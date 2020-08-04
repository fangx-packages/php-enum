<?php
declare(strict_types=1);

namespace Fangx\Tests\Stubs;

use Fangx\Enum\Contracts\Definition;
use Fangx\Enum\Contracts\Format;

class CustomFormat implements Format
{
    public function parse(Definition $definition): array
    {
        return [[
                'name' => $definition->getValue(),
                'value' => $definition->getKey(),
            ]];
    }
}
