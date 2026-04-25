<?php

namespace App\Core;

class Container
{
    private array $bindings = [];

    public function bind($abstract, $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

   public function make($class)
    {
        $reflector = new ReflectionClass($class);

        $constructor = $reflector->getConstructor();

        if (!$constructor) {
            return new $class;
        }

        $params = $constructor->getParameters();

        $dependencies = [];

        foreach ($params as $param) {
            $type = $param->getType()->getName();
            $dependencies[] = $this->make($type);
        }

        return $reflector->newInstanceArgs($dependencies);
    }
}