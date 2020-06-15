<?php
declare(strict_types=1);

namespace Fangx\Enum\Concerns;

trait SupportJsonSerializable
{
    public function jsonSerialize()
    {
        return $this->items;
    }
}
