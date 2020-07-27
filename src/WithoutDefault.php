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

namespace Fangx\Enum;

use Fangx\Enum\Contracts\Definition;
use Fangx\Enum\Contracts\Filter;

class WithoutDefault implements Filter
{
    /**
     * @var mixed
     */
    protected $default;

    public function __construct($default = 0)
    {
        $this->default = $default;
    }

    public function __invoke(Definition $definition)
    {
        return $definition->getKey() === $this->default;
    }
}
