<?php 

namespace Qonsillium;

class SocketCreator implements Actionable
{
    protected string $host;

    protected int $port;

    private $createdSocket;

    public function __construct(string $host, int $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function make()
    {
        
    }

    public function getCreatedSocket()
    {
        return $this->createdSocket;
    }
}
