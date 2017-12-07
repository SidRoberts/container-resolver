<?php

namespace Sid\ContainerResolver\Test\Unit;

use Codeception\TestCase\Test;

use Symfony\Component\DependencyInjection\Container;

use Sid\ContainerResolver\Resolver\Psr11;

class SymfonyTest extends Test
{
    public function test()
    {
        $container = new Container();



        $a = "abc" . mt_rand();
        $b = "abc" . mt_rand();

        $container->set("a", $a);
        $container->set("b", $b);



        $resolver = new Psr11($container);

        $class = $resolver->typehintClass(
            \Example::class
        );



        $actualA = $class->getA();
        $actualB = $class->getB();

        $this->assertEquals($a, $actualA);
        $this->assertEquals($b, $actualB);
    }

    public function testMethod()
    {
        $container = new Container();



        $a = "abc" . mt_rand();
        $b = "abc" . mt_rand();

        $container->set("a", $a);
        $container->set("b", $b);



        $methodExample = new \MethodExample();



        $resolver = new Psr11($container);

        $expected = $a;
        $actual   = $resolver->typehintMethod(
            $methodExample,
            "single"
        );

        $this->assertEquals($expected, $actual);



        $actual = $resolver->typehintMethod(
            $methodExample,
            "multiple"
        );

        $this->assertEquals($a, $actual["a"]);
        $this->assertEquals($b, $actual["b"]);
    }

    public function testTypehintFunction()
    {
        $container = new Container();



        $a = "abc" . mt_rand();
        $b = "abc" . mt_rand();

        $container->set("a", $a);
        $container->set("b", $b);



        $resolver = new Psr11($container);



        $expected = hello($a, $b);
        $actual   = $resolver->typehintFunction("hello");

        $this->assertEquals($expected, $actual);
    }
}
