<?php 

namespace Qonsillium;

class SocketConnector implements Actionable
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
        
    }

}
