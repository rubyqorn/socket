<?php 

namespace Qonsillium\Actions;

use \Socket;

class SocketAcceptor extends AbstractSocketAction
{
    /**
     * Accepted socket connection
     * @var \Socket 
     */ 
    private $acceptedSocket;

    /**
     * @param \Socket $socket
     * @return void 
     */ 
    public function setAcceptSocket(Socket $socket)
    {
        $this->acceptedSocket = $socket;
    }

    /**
     * @return \Socket 
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
