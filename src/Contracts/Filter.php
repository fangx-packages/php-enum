<?php
declare(strict_types=1);

namespace Fangx\Enum\Contracts;

interface Filter
{
    public function __invoke(Definition $definition);
}
