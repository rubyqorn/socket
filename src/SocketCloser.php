<?php 

namespace Qonsillium;

class SocketCloser implements Actionable
{
    private $socket;

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
        
    }
}
