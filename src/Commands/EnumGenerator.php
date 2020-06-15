<?php
declare(strict_types=1);

namespace Fangx\Enum\Commands;

class EnumGenerator
{
    protected $root;

    public function __construct($rootPath)
    {
        $this->root = $rootPath;
    }

    public function run($name, $options)
    {
        $classname = ucfirst($name);

        [$path, $enums] = $this->validation($options);

        $constants = $this->constants($this->parse($enums));

        $stub = $this->stub();

        $fullname = str_replace('/', '\\', $path . '/' . $classname);

        $namespace = trim(implode('\\', array_slice(explode('\\', $fullname), 0, -1)), '\\');

        $filepath = $this->root . '/' . $path . '/' . $classname . '.php';

        $stub = str_replace(
            ['DummyNamespace', 'DummyClass', 'DummyConstants'],
            [$namespace, $classname, $constants],
            $stub
        );

        $this->makeDirectory(dirname($filepath));

        file_put_contents($filepath, $stub);

        return sprintf('enum class {%s} is created.' . PHP_EOL, $classname);
    }

    protected function stub()
    {
        return <<<STUB
<?php
namespace DummyNamespace;

use Fangx\Enum\AbstractEnum;

class DummyClass extends AbstractEnum
{
    DummyConstants
}
STUB;
    }

    protected function parse($enums)
    {
        $constants = [];
        foreach ((array)$enums as $index => $enum) {
            if (strpos($enum, '=') === false) {
                array_push($constants, [$index, $enum]);
            } else {
                array_push($constants, explode('=', $enum));
            }
        }
        return $constants;
    }

    protected function constants($enums)
    {
        $constants = '';
        foreach ($enums as $enum) {
            $constants .= sprintf(
                '    const %s = %s, __%s = "%s";' . PHP_EOL,
                strtoupper($enum[1]),
                is_numeric($enum[0]) ? $enum[0] : '"' . $enum[0] . '"',
                strtoupper($enum[1]),
                $enum[1]
            );
        }
        return trim($constants);
    }

    private function validation($options)
    {
        $path = $options['path'] ?? '';

        $enums = (array)($options['enum'] ?? []);

        if (!$path || !$enums) {
            trigger_error('params [path|enum] is valid! ', E_USER_ERROR);
        }

        return [$path, $enums];
    }

    private function makeDirectory($directory)
    {
        if (!is_dir($directory)) {
            @mkdir($directory, 0777, true);
        }
    }
}
