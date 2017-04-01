<?php

require_once 'amqp_connect.php';

$channel = $connection->channel();
$channel->queue_declare('queue', false, true, false, false);

$callback = function($msg) {
    error_log(" [x] Received {$msg->body} \n");
};

$channel->basic_consume('queue', '', false, true, false, false, $callback);

error_log("Beginning loop");
while(count($channel->callbacks)) {
    $channel->wait();
}
