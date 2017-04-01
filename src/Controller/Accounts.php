<?php

namespace App\Controller;

class Accounts
{
    protected $view;
    protected $flash;

    public function __construct($view, $flash)
    {
        $this->view = $view;
        $this->flash = $flash;
    }

    public function accounts($request, $response)
    {
        
    }
}
