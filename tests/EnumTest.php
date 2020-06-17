<?php

declare(strict_types=1);

/**
 * Fangx's Packages
 *
 * @link     https://github.com/fangx-packages/hyperf-resource
 * @document https://github.com/fangx-packages/hyperf-resource/blob/master/README.md
 * @contact  nfangxu@gmail.com
 * @author   nfangxu
 */

use Fangx\Enum\Contracts\Definition;
use Fangx\Enum\Contracts\Format;
use Fangx\Enum\UnFormat;
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

        $filter = new class() implements \Fangx\Enum\Contracts\Filter {
            public function __invoke(Definition $definition)
            {
                return $definition->getKey() === 'f';
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
}

class FooEnum extends \Fangx\Enum\AbstractEnum
{
    const FOO = 'f';

    const __FOO = 'foo';

    const BAR = 'b';

    const __BAR = 'bar';
}

class BarEnum extends \Fangx\Enum\AbstractEnum
{
    public function all()
    {
        return [
            new \Fangx\Enum\Definition('f', 'foo'),
            new \Fangx\Enum\Definition('b', 'bar'),
        ];
    }
}
