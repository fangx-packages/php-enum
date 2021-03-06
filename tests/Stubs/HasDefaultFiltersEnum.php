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

namespace Fangx\Tests\Stubs;

use Fangx\Enum\WithoutDefault;

class HasDefaultFiltersEnum extends ExampleEnum
{
    public function filters()
    {
        return [
            new WithoutDefault(),
            new WithoutDefault('unknown'),
        ];
    }
}
