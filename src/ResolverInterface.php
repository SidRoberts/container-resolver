<?php

namespace Sid\ContainerResolver;

interface ResolverInterface
{
    /**
     * Typehint a class using the properties in its constructor. If no constructor is present, a new instance is made
     * anyway.
     */
    public function typehintClass(string $className, array $custom = []);

    /**
     * Typehint a class method.
     */
    public function typehintMethod($class, string $method, array $custom = []);

    /**
     * Typehint a function.
     */
    public function typehintFunction(string $functionName, array $custom = []);
}
