<?php

define("BASEDIR", dirname(dirname(__FILE__)));
require_once BASEDIR.'/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connectionUrl = getenv("CLOUDAMQP_URL");
$config = parse_url($connectionUrl);
$connected = false;

while (!$connected) {
    try {
        $connection = new AMQPStreamConnection($config['host'], 5672, $config['user'], $config['pass'], substr($config['path'], 1));
        $connected = true;
    } catch (\ErrorException $e) {
        error_log("Unable to connect, sleeping for a 5 seconds");
        sleep(5);
    }
}
error_log("Worker connected successfully");
