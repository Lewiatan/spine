<?php namespace Spine;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Mockery\CountValidator\Exception;

class Spine {
    private $vertebrae = [
        'Asset' => 'Spine\Asset',
        'Metabox' => 'Spine\Metabox',
        'Field' => 'Spine\Form\Field',
        'Input' => 'Spine\Form\Input',
    ];

    private function __construct() {}

    public static function assemble() {
        return new static;
    }

    public function __get($vertebra) {
        if (! array_key_exists($vertebra, $this->vertebrae)) {
            $vertebra = ucfirst($vertebra);
        }

        if (! array_key_exists($vertebra, $this->vertebrae)) {
            throw new \Exception('Vertebra does not exist');
        }

        return $this->resolve(ucfirst($vertebra));
    }

    public function attach($vertebra, $class) {
        $this->vertebrae[$vertebra] = $class;

        return $this;
    }

    public function detach($toDetach) {
        foreach ($this->vertebrae as $vertebra => $class) {
            if ($vertebra === $toDetach) {
                unset($this->vertebrae[$vertebra]);
            }
        }

        return $this;
    }

    public function getVertebrae() {
        return $this->vertebrae;
    }

    public function reset() {
        $this->vertebrae = [];

        return $this;
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