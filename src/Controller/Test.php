<?php

namespace App\Controller;

use PhpAmqpLib\Message\AMQPMessage;

class Test
{
    protected $view;
    protected $flash;
    protected $connection;

    public function __construct($view, $flash, $connection)
    {
        $this->view = $view;
        $this->flash = $flash;
        $this->connection = $connection;
    }

    public function index($request, $response)
    {
        $msg = new AMQPMessage(hash('sha256',uniqid()));
        $channel = $this->connection->channel();
        $channel->queue_declare('queue', false, true, false, false);
        $channel->exchange_declare('exchange', 'direct', false, true, false);
        $channel->queue_bind('queue', 'exchange');
        $channel->basic_publish($msg, 'exchange', 'hello');
        echo " [x] Sent 'Hello World!'\n";
        $channel->close();
        $this->connection->close();
    }
}
