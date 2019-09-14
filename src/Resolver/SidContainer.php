<?php

namespace Sid\ContainerResolver\Resolver;

use ReflectionParameter;
use Sid\Container\Container;
use Sid\ContainerResolver\Resolver;

class SidContainer extends Resolver
{
    /**
     * @var Container
     */
    protected $container;



    public function __construct(Container $container)
    {
        $this->container = $container;
    }



    protected function resolveParam(ReflectionParameter $reflectionParameter)
    {
        $name = $reflectionParameter->getName();

        $service = $this->container->get($name);

        return $service;
    }
}
