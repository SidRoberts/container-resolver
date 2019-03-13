# Container Resolver

A standardised way to typehint classes, methods and functions with any container.

[![Build Status](https://travis-ci.org/SidRoberts/container-resolver.svg?branch=master)](https://travis-ci.org/SidRoberts/container-resolver)
[![GitHub tag](https://img.shields.io/github/tag/sidroberts/container-resolver.svg?maxAge=2592000)]()



## Installation

```bash
composer require sidroberts/container-resolver
```



## Usage

Using sidroberts/flash as a real-life example, `Sid\Flash\Flash` requires two parameters: a Symfony Session object and a Flash Formatter object. Typically, you'd have to specify these manually:

```php
$session   = new \Symfony\Component\HttpFoundation\Session\Session();
$formatter = new \Sid\Flash\Formatter\Html();

$flash = new \Sid\Flash\Flash($session, $formatter);
```

The code in this example is perfectly acceptable and perfectly fine but it can become very tiresome if you have an application with many objects or what if you don't know what parameters a class takes? What about if you want to be able to modify a controller's dependencies quickly without having to alter the controller's instantiation code?

With the Container Resolver, you place all of your dependencies into a container and allow it to automatically determine the required parameters:

```php
$container = new \Symfony\Component\DependencyInjection\Container();

// ...



$resolver = new \Sid\ContainerResolver\Resolver\Psr11($container);

/**
 * @var \Sid\Flash\Flash
 */
$flash = $resolver->typehintClass(
    \Sid\Flash\Flash::class
);
```

You can also typehint methods:

```php
use Doctrine\ORM\EntityManager;

class Example
{
    public function methodName(EntityManager $doctrine, Auth $auth)
    {
        return get_class($doctrine) . " and " . get_class($auth);
    }
}

$object = new Example();

// "Doctrine\ORM\EntityManager and Auth"
$resolver->typehintMethod(
    $object,
    "method_name"
);
```

And functions:

```php
use Doctrine\ORM\EntityManager;

function hello(EntityManager $doctrine, Auth $auth)
{
    return get_class($doctrine) . " and " . get_class($auth);
}

// "Doctrine\ORM\EntityManager and Auth"
$resolver->typehintFunction("hello");
```
