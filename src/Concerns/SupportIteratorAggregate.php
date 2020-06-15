<?php
declare(strict_types=1);

namespace Fangx\Enum\Concerns;

use ArrayIterator;

trait SupportIteratorAggregate
{
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }
}
