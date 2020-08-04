<?php
declare(strict_types=1);

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
