<?php

namespace App\Controller;

/**
 * Class TestController
 * @package App\Controller
 */
class TestController
{
    /**
     * @var string
     */
    private $helloWorldMsg;

    /**
     * TestController constructor.
     *
     * @param string $helloWorldMsg
     */
    public function __construct(string $helloWorldMsg)
    {
        $this->helloWorldMsg = $helloWorldMsg;
    }

    /**
     * @return void
     */
    public function helloWorld()
    {
        echo $this->helloWorldMsg;
    }
}