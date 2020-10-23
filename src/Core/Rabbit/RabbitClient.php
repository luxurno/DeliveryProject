<?php

declare(strict_types = 1);

namespace App\Core\Rabbit;

use App\Core\Rabbit\Config\RabbitConfig;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitClient
{
    /** @var RabbitConfig */
    private $rabbitConfig;
    /** @var AMQPStreamConnection */
    private $connection;

    public function __construct(RabbitConfig $rabbitConfig)
    {
        $this->rabbitConfig = $rabbitConfig;
        $this->connection = new AMQPStreamConnection(
            $this->rabbitConfig->getHost(),
            $this->rabbitConfig->getPort(),
            $this->rabbitConfig->getUser(),
            $this->rabbitConfig->getPass(),
            $this->rabbitConfig->getVhost()
        );
    }

    public function getConnection(): AMQPStreamConnection
    {
        return $this->connection;
    }

    public function getConfig(): RabbitConfig
    {
        return $this->rabbitConfig;
    }
}
