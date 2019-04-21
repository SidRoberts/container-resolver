<?php

namespace Tests;

class MethodExample
{
    public function single($a)
    {
        return $a;
    }

    public function multiple($a, $b)
    {
        return [
            "a" => $a,
            "b" => $b,
        ];
    }
}
