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

use Fangx\Enum\AbstractEnum;

class NumberKeyEnum extends AbstractEnum
{
    const ZERO = 0;

    const __ZERO = 'zero';

    const ONE = 1;

    const __ONE = 'one';

    const TWO = 2;

    const __TWO = 'two';
}
