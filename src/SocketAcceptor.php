<?php 

namespace Qonsillium;

class SocketAcceptor extends AbstractSocketAction
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
        return socket_accept($this->getAcceptedSocket());
    }
}
