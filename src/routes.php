<?php

$app->get('/', function($request, $response) {
    return $response->withRedirect('/reports');
});

$app->map(['GET', "POST"], '/login', 'AuthController:login');

$app->any('/logout', 'AuthController:logout');

$app->group('/facebook', function() use ($app) {
    $app->group('/audiences', function() use ($app) {

    });
    $app->group('/pixels', function() use ($app) {

    });
    $app->group('/accounts', function() use ($app) {

    });
})->add(new \App\Middleware\Authorization());

$app->get('/profile', 'ProfileController:index')->add(new \App\Middleware\Authorization());
$app->get('/auth/callback', 'ProfileController:install')->add(new \App\Middleware\Authorization());

$app->get('/test','TestController:index');
