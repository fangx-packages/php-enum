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

class FooEnum extends AbstractEnum
{
    const FOO = 'f';

    const __FOO = 'foo';

    const BAR = 'b';

    const __BAR = 'bar';
}
