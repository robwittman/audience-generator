<?php

namespace App\Controller;

use App\Model\User;
use Facebook\Facebook;
class Profile
{
    protected $view;
    protected $flash;

    public function __construct($view, $flash)
    {
        $this->view = $view;
        $this->flash = $flash;
    }

    public function index($request, $response)
    {
        $client_id = getenv("CLIENT_ID");
        $redirect_url = getenv("REDIRECT_URI");
        $user = User::find($_SESSION['uid']);
        return $this->view->render($response, 'profile/index.html', array(
            'user' => $user,
            'redirect_url' => $redirect_url,
            'client_id' => $client_id
        ));
    }

    public function install($request, $response)
    {
        $code = $_GET['code'];
        $clientId = getenv("CLIENT_ID");
        $clientSecret = getenv("CLIENT_SECRET");
        $redirectUri = getenv("REDIRECT_URI");

        $fb = new Facebook(array(
            'app_id' => $clientId,
            'app_secret' => $clientSecret
        ));

        $params = array(
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'code' => $code,
            'redirect_uri' => $redirectUri
        );

        $res = $fb->get('/oauth/access_token?'.http_build_query($params), 'abcd1234');
        $token = $res->getDecodedBody()['access_token'];
        $profile = $fb->get('/me?fields=name',$token);
        $profile = $profile->getDecodedBody();
        $user = User::find($_SESSION['uid']);
        $user->facebook_user_id = $profile['id'];
        $user->facebook_user_name = $profile['name'];
        $user->access_token = $token;
        $user->save();
        $this->flash->addMessage("message", "Successfully authenticated as {$user->facebook_user_name}");
        return $response->withRedirect('/profile');
    }
}
