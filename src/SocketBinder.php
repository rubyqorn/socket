<?php 

namespace Qonsillium;

class SocketBinder extends AbstractSocketAction
{
    private $socket;

    private string $host;

    private int $port;

    public function __construct(string $host, int $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    public function getSocket()
    {
        return $this->socket;
    }

    public function make()
    {
        return socket_bind($this->getSocket(), $this->host, $this->port);
    }
}
