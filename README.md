# PHP Enum Packages

## Install

Via Composer

```bash
composer require fangx/php-enum
```

## Usage

使用 `./vendor/bin/enum` 命令创建一个枚举类. 

```bash
./vendor/bin/enum FooEnum --enum="1=foo" --enum="b=bar" --path=Enums
```

该命令默认在 当前目录的 Enums 目录下创建一个 FooEnum.php 文件. 文件内容如下:

```php
<?php
namespace Enums;

use Fangx\Enum\AbstractEnum;

class FooEnum extends AbstractEnum
{
    const FOO = "f", __FOO = "foo";
    const BAR = "b", __BAR = "bar";
}
```

枚举类默认继承 `\Fangx\Enum\AbstractEnum`. 可以静态调用以下方法: 

- `toArray(Format $format = null, Filter $filter = null)`
- `toJson(Format $format = null, Filter $filter = null)`
- `desc($key, $default = 'Undefined')`

### 获取所有的枚举值

```php
<?php

class FooEnum extends \Fangx\Enum\AbstractEnum
{
    const FOO = 'f', __FOO = 'foo';
    const BAR = 'b', __BAR = 'bar';
}

/**
 * ['f' => 'foo', 'b' => 'bar']
 */
FooEnum::toArray();
```

### 获取枚举值的描述信息
```php
<?php

class FooEnum extends \Fangx\Enum\AbstractEnum
{
    const FOO = 'f', __FOO = 'foo';
    const BAR = 'b', __BAR = 'bar';
}

/**
 * "foo"
 */
FooEnum::desc('f');

/**
 * "bar"
 */
FooEnum::desc('b');
```

### 使用格式来约束返回值

```php
<?php
class FooFormat implements \Fangx\Enum\Contracts\Format
{
    public function parse(\Fangx\Enum\Contracts\Definition $definition): array
    {
        return [['key' => $definition->getKey() , 'value' => $definition->getValue()]];
    }
}

class FooEnum extends \Fangx\Enum\AbstractEnum
{
    const FOO = 'f', __FOO = 'foo';
    const BAR = 'b', __BAR = 'bar';
}

/**
 * [['key' => 'f', 'value' => 'foo'], ['key' => 'b', 'value' => 'bar'],]
 */
$format = new FooFormat();
FooEnum::toArray($format);
```

### 通过规则来过来过滤枚举值.

```php
class FooFilter implements \Fangx\Enum\Contracts\Filter
{
    public function __invoke(\Fangx\Enum\Contracts\Definition $definition)
    {
        return $definition->getKey() === 'f';
    }
}

/**
 * ['f' => 'foo']
 */
$filter = new FooFilter();
FooEnum::toArray(null, $filter);
```

### 使用自定义的集合来作为所有的枚举类型, 其他使用方法与 `FooEnum` 一致.

```php
<?php
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
```

## Test

```bash
composer test
```