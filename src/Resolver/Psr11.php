<?php

namespace Sid\ContainerResolver\Resolver;

use Psr\Container\ContainerInterface;
use ReflectionParameter;
use Sid\ContainerResolver\Resolver;

class Psr11 extends Resolver
{
    /**
     * @var ContainerInterface
     */
    protected $container;



    public function __construct(ContainerInterface $container)
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
