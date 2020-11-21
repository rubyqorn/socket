<?php 

namespace Qonsillium;

class SocketAcceptor implements Actionable
{
    private $acceptedSocket;

    public function setAcceptSocket($socket)
    {
        $this->acceptedSocket = $socket;
    }

    public function getAcceptedSocket()
    {
        return $this->acceptedSocket;
    }

    public function make()
    {
        
    }
}
