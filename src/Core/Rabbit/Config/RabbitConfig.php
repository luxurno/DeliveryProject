<?php

declare(strict_types = 1);

namespace App\Core\Rabbit\Config;

class RabbitConfig
{
    /** @var string */
    private $host;
    /** @var string */
    private $port;
    /** @var string */
    private $user;
    /** @var string */
    private $pass;
    /** @var string */
    private $vhost;
    /** @var int */
    private $queueCount;

    public function __construct()
    {
        $this->host = getenv('RABBIT_HOST');
        $this->port = getenv('RABBIT_PORT');
        $this->user = getenv('RABBIT_USER');
        $this->pass = getenv('RABBIT_PASS');
        $this->vhost = getenv('RABBIT_VHOST');
        $this->queueCount = (int) getenv('RABBIT_ADDRESS_QUEUE_COUNT');
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): string
    {
        return $this->port;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    public function getVhost(): string
    {
        return $this->vhost;
    }

    public function getQueueCount(): int
    {
        return $this->queueCount;
    }
}
