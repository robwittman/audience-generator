<?php

namespace App\Controller;

class Pixels
{
    protected $view;
    protected $flash;

    public function __construct($view, $flash)
    {
        $this->view = $view;
        $this->flash = $flash;
    }
}
