<?php

namespace Tests;

use Sid\Container\Container;
use Sid\ContainerResolver\Resolver\SidContainer;

class SidContainerCest
{
    public function test(UnitTester $I)
    {
        $container = new Container();



        $a = "abc" . mt_rand();
        $b = "abc" . mt_rand();

        $container->set("a", $a);
        $container->set("b", $b);



        $resolver = new SidContainer($container);

        $class = $resolver->typehintClass(
            Example::class
        );



        $actualA = $class->getA();
        $actualB = $class->getB();

        $I->assertEquals($a, $actualA);
        $I->assertEquals($b, $actualB);
    }

    public function method(UnitTester $I)
    {
        $container = new Container();



        $a = "abc" . mt_rand();
        $b = "abc" . mt_rand();

        $container->set("a", $a);
        $container->set("b", $b);



        $methodExample = new MethodExample();



        $resolver = new SidContainer($container);

        $expected = $a;
        $actual   = $resolver->typehintMethod(
            $methodExample,
            "single"
        );

        $I->assertEquals($expected, $actual);



        $actual = $resolver->typehintMethod(
            $methodExample,
            "multiple"
        );

        $I->assertEquals($a, $actual["a"]);
        $I->assertEquals($b, $actual["b"]);
    }

    public function typehintFunction(UnitTester $I)
    {
        $container = new Container();



        $a = "abc" . mt_rand();
        $b = "abc" . mt_rand();

        $container->set("a", $a);
        $container->set("b", $b);



        $resolver = new SidContainer($container);



        $expected = \hello($a, $b);
        $actual   = $resolver->typehintFunction("hello");

        $I->assertEquals($expected, $actual);
    }
}
