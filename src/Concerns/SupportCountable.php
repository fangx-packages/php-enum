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

trait SupportCountable
{
    public function count()
    {
        return count($this->items);
    }
}
