<?php

namespace App\Infrastructure;

class RequestOO
{
    /**
     * @var Parameters
     */
    private $query;

    /**
     * @var Parameters
     */
    private $post;

    /**
     * @var Parameters
     */
    private $cookie;

    public function getQuery(): Parameters
    {
        if ($this->query === null) {
            $this->query = new Parameters($_GET);
        }

        return $this->query;
    }

    public function getPost(): Parameters
    {
        if ($this->post === null) {
            $this->post = new Parameters($_POST);
        }

        return $this->post;
    }

    public function getCookie(): Parameters
    {
        if ($this->cookie === null) {
            $this->cookie = new Parameters($_COOKIE);
        }

        return $this->cookie;
    }
}
