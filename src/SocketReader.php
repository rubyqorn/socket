<?php 

namespace Qonsillium;

class SocketReader implements Actionable
{
    private $socket;

    private string $message = '';

    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    public function getSocket()
    {
        return $this->socket;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function make()
    {
        
    }
}
