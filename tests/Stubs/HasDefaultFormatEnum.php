<?php
declare(strict_types=1);

namespace Fangx\Tests\Stubs;

use Fangx\Enum\Contracts\Format;

class HasDefaultFormatEnum extends ExampleEnum
{
    public function format(): ?Format
    {
        return new CustomFormat();
    }
}
