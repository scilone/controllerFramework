<?php

namespace App\Config;

Class Param
{
    public const HELLO_WORLD = 'Hello world!';

    public const TWIG_GLOBAL_VARS = [
        'helloWorld' => self::HELLO_WORLD,
    ];
}
