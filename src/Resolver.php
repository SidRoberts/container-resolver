<?php

namespace Sid\ContainerResolver;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionParameter;

abstract class Resolver implements ResolverInterface
{
    /**
     * Typehint a class using the properties in its constructor. If no
     * constructor is present, a new instance is made anyway.
     */
    final public function typehintClass(string $className, array $custom = [])
    {
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->hasMethod("__construct")) {
            return $reflectionClass->newInstance();
        }

        $reflectionMethod = $reflectionClass->getMethod("__construct");

        $reflectionParameters = $reflectionMethod->getParameters();

        $params = $this->resolveParams($reflectionParameters, $custom);

        return $reflectionClass->newInstanceArgs($params);
    }



    /**
     * Typehint a class method.
     */
    final public function typehintMethod($class, string $method, array $custom = [])
    {
        $className = get_class($class);

        $reflectionMethod = new ReflectionMethod($className, $method);

        $reflectionParameters = $reflectionMethod->getParameters();

        $params = $this->resolveParams($reflectionParameters, $custom);

        return call_user_func_array(
            [
                $class,
                $method,
            ],
            $params
        );
    }



    /**
     * Typehint a function.
     */
    final public function typehintFunction(string $functionName, array $custom = [])
    {
        $reflectionFunction = new ReflectionFunction($functionName);

        $reflectionParameters = $reflectionFunction->getParameters();

        $params = $this->resolveParams($reflectionParameters, $custom);

        return call_user_func_array(
            $functionName,
            $params
        );
    }



    final protected function resolveParams(array $reflectionParameters, array $custom) : array
    {
        $params = [];

        foreach ($reflectionParameters as $reflectionParameter) {
            if (!($reflectionParameter instanceof ReflectionParameter)) {
                throw new InvalidArgumentException();
            }



            $name = $reflectionParameter->getName();

            if (isset($custom[$name])) {
                $params[] = $custom[$name];
            } else {
                $params[] = $this->resolveParam($reflectionParameter);
            }
        }

        return $params;
    }

    abstract protected function resolveParam(ReflectionParameter $reflectionParamter);
}
