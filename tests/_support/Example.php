<?php

namespace Tests;

class Example
{
    protected $a;
    protected $b;



    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
    }



    public function getA()
    {
        return $this->a;
    }

    public function getB()
    {
        return $this->b;
    }
}
