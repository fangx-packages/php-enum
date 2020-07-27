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

namespace Fangx\Tests;

/*
 * Fangx's Packages
 *
 * @link     https://github.com/fangx-packages/hyperf-resource
 * @document https://github.com/fangx-packages/hyperf-resource/blob/master/README.md
 * @contact  nfangxu@gmail.com
 * @author   nfangxu
 */

use Fangx\Enum\Contracts\Definition;
use Fangx\Enum\Contracts\Filter;
use Fangx\Enum\Contracts\Format;
use Fangx\Enum\UnFormat;
use Fangx\Enum\WithoutDefault;
use Fangx\Tests\Stubs\BarEnum;
use Fangx\Tests\Stubs\ExampleEnum;
use Fangx\Tests\Stubs\FooEnum;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class EnumTest extends TestCase
{
    public function testAll()
    {
        $unFormat = new UnFormat();

        $format = new class() implements Format {
            public function parse(Definition $definition): array
            {
                return [['key' => $definition->getKey(), 'value' => $definition->getValue()]];
            }
        };

        $filter = new class() implements Filter {
            public function __invoke(Definition $definition)
            {
                return $definition->getKey() !== 'f';
            }
        };

        $this->assertSame(['f' => 'foo', 'b' => 'bar'], FooEnum::toArray());
        $this->assertSame(['f' => 'foo', 'b' => 'bar'], BarEnum::toArray());
        $this->assertSame('{"f":"foo","b":"bar"}', FooEnum::toJson());
        $this->assertSame('{"f":"foo","b":"bar"}', BarEnum::toJson());
        $this->assertSame(['f' => 'foo', 'b' => 'bar'], FooEnum::toArray($unFormat));
        $this->assertSame(['f' => 'foo', 'b' => 'bar'], BarEnum::toArray($unFormat));
        $this->assertSame('foo', FooEnum::desc(FooEnum::FOO));
        $this->assertSame('foo', BarEnum::desc('f'));
        $this->assertSame([['key' => 'f', 'value' => 'foo'], ['key' => 'b', 'value' => 'bar']], FooEnum::toArray($format));
        $this->assertSame([['key' => 'f', 'value' => 'foo'], ['key' => 'b', 'value' => 'bar']], BarEnum::toArray($format));
        $this->assertSame(['f' => 'foo'], FooEnum::toArray(null, $filter));
        $this->assertSame(['f' => 'foo'], BarEnum::toArray(null, $filter));
    }

    public function testFilter()
    {
        $this->assertSame(['f' => 'Foo', 'b' => 'Bar', 0 => 'default', 'unknown' => 'unknown'], ExampleEnum::toArray());
        $this->assertSame(['f' => 'Foo', 'b' => 'Bar', 'unknown' => 'unknown'], ExampleEnum::toArray(null, new WithoutDefault()));
        $this->assertSame(['f' => 'Foo', 'b' => 'Bar'], ExampleEnum::toArray(null, new WithoutDefault(), new WithoutDefault('unknown')));
    }
}
