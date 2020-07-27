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

class ExampleEnum extends AbstractEnum
{
    const FOO = 'f';

    const __FOO = 'Foo';

    const BAR = 'b';

    const __BAR = 'Bar';

    const EXAMPLE_DEFAULT = 0;

    const __EXAMPLE_DEFAULT = 'default';

    const EXAMPLE_UNKNOWN = 'unknown';

    const __EXAMPLE_UNKNOWN = 'unknown';
}
