<?php namespace Spine;

class Spine {
    private $vertebrae = [
        'Asset' => 'Spine\Asset',
        'Metabox' => 'Spine\Metabox',
        'Field' => 'Spine\Form\Field',
        'Input' => 'Spine\Form\Input',
//        'Wordpress' => 'Spine\Adapters\Wordpress'
    ];

    private function __construct() {}

    public static function assemble() {
        return new static;
    }

    public function __get($vertebra) {
        return $this->resolve(ucfirst($vertebra));
    }

    public function attach($vertebra, $class) {
        $this->vertebrae[$vertebra] = $class;
    }

    private function resolve($vertebra) {
        $dependencies = [];
        $reflector = new \ReflectionClass($this->vertebrae[$vertebra]);
        $constructor = $reflector->getConstructor();

        if ($constructor) {
            $dependencies = $constructor->getParameters();
            $dependencies = static::makeDependencies($dependencies);
        }

        return $reflector->newInstanceArgs($dependencies);
    }

    private function makeDependencies(array $dependencies) {
        $deps = [];

        foreach ($dependencies as $dependency) {
            $class = $dependency->getClass();
            $className = $class->name;

            if ($class->hasMethod('make') && $class->getMethod('make')->isStatic()) {
                $deps[] = $className::make();
            } else {
                $deps[] = new $className;
            }
        }

        return $deps;
    }

}