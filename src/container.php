<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$container = $app->getContainer();
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('../views');
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    $view->getEnvironment()->addGlobal('flash', $c['flash']);
    $view->getEnvironment()->addGlobal('store', getenv("MYSHOPIFY_DOMAIN"));
    return $view;
};
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$capsule->getContainer()->singleton(
    \Illuminate\Contracts\Debug\ExceptionHandler::class,
    \App\CustomException::class
);

$container['db'] = function ($c) {
    return $capsule;
};

$container['flash'] = function ($c) {
    return new Slim\Flash\Messages();
};


$container['AuthController'] = function ($c) {
    $view = $c->get('view');
    $flash = $c->get('flash');
    return new \App\Controller\Auth($view, $flash);
};

$container['ProfileController'] = function ($c) {
    $view = $c->get('view');
    $flash = $c->get('flash');
    return new \App\Controller\Profile($view, $flash);
};

$container['TestController'] = function($c) {
    return new \App\Controller\Test(
        $c->get('view'),
        $c->get('flash'),
        $c->get('rabbit')
    );
};

$container['rabbit'] = function($c) {
    $url = getenv("CLOUDAMQP_URL");
    $config = parse_url($url);
    $connection = new AMQPStreamConnection(
        $config['host'],
        5672,
        $config['user'],
        $config['pass'],
        substr($config['path'], 1)
    );
    return $connection;
};
