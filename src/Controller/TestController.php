<?php

namespace App\Controller;

use App\Application\Twig;

class TestController
{
    /**
     * @var Twig
     */
    private $twig;

    /**
     * @var string
     */
    private $helloWorldMsg;

    public function __construct(Twig $twig, string $helloWorldMsg)
    {
        $this->twig          = $twig;
        $this->helloWorldMsg = $helloWorldMsg;
    }

    public function helloWorld(): void
    {
        echo $this->twig->render('testHelloWorld.html.twig', ['msg' => $this->helloWorldMsg]);
    }
}
