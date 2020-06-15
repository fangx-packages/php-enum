<?php
declare(strict_types=1);

namespace Fangx\Enum\Contracts;

interface Format
{
    public function parse(Definition $definition): array;
}
