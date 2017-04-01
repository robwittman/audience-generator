<?php

error_log(Json_encode($_GET));
session_start();
require_once '../vendor/autoload.php';
// require_once '../src/common.php';

$dbUrl = getenv("DATABASE_URL");
$dbConfig = parse_url($dbUrl);

$app = new Slim\App(array(
    'settings' => array(
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,
        'db' => array(
            'driver' => 'pgsql',
            'host' => $dbConfig['host'],
            'database' => ltrim($dbConfig['path'], '/'),
            'username' => $dbConfig['user'],
            'password' => $dbConfig['pass'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        )
    )
));

require_once '../src/routes.php';
require_once '../src/container.php';
$app->run();
