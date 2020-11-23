<?php 

namespace Qonsillium;

class SocketAcceptor extends AbstractSocketAction
{
    /**
     * Accepted socket connection
     * @var resource 
     */ 
    private $acceptedSocket;

    /**
     * @param resource $socket
     * @return void 
     */ 
    public function setAcceptSocket($socket)
    {
        $this->acceptedSocket = $socket;
    }

    /**
     * @return resource 
     */ 
    public function getAcceptedSocket()
    {
        return $this->acceptedSocket;
    }

    /**
     * Accept socket connection
     * @return resource 
     */ 
    public function make()
    {
        return socket_accept($this->getAcceptedSocket());
    }
}
