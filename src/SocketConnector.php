<?php 

namespace Qonsillium;

class SocketConnector extends AbstractSocketAction
{
    private $socket;

    private string $host;

    private int $port;

    public function __construct(string $host, int $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function setCreatedSocket($socket)
    {
        $this->socket = $socket;
    }

    public function getConnectedSocket()
    {
        return $this->socket;
    }

    public function make()
    {
        return socket_connect($this->getConnectedSocket(), $this->host, $this->port);
    }
}
