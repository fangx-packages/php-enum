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

namespace Fangx\Enum\Concerns;

use ArrayIterator;

trait SupportIteratorAggregate
{
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }
}
