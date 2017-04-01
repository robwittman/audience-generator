<?php

namespace App\Middleware;

use App\Model\User;

class FacebookUser
{
    public function __invoke($request, $response, $next)
    {
        return $next($request, $response);
        $user = User::find($_SESSION['uid']);
        if (is_null($user->facebook_user_id)) {
            return $response->withRedirect('/profile');
        }
        $request = $request->withAttribute('fbid', $user->facebook_user_id);
    }
}
