<?php

namespace App\Middleware;

class Authorization
{
    public function __invoke($request, $response, $next)
    {
        if (!isset($_SESSION['uid'])) {
            return $response->withRedirect('/login');
        }

        return $next($request, $response);
    }
}
