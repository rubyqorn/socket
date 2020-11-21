<?php 

namespace Qonsillium;

class SocketWriter implements Actionable
{
    private $socket;

    private string $message;

    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    public function getSocket()
    {
        return $this->socket;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function make()
    {
        
    }
}
