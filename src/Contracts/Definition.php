<?php
declare(strict_types=1);

namespace Fangx\Enum\Contracts;

interface Definition
{
    public function getKey();

    public function getValue();
}
