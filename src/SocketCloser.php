<?php 

namespace Qonsillium;

class SocketCloser extends AbstractSocketAction
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
        return socket_close($this->getSocket());
    }
}
