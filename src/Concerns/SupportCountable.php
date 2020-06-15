<?php
declare(strict_types=1);

namespace Fangx\Enum\Concerns;

trait SupportCountable
{
    public function count()
    {
        return count($this->items);
    }
}
