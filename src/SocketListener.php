<?php 

namespace Qonsillium;

class SocketListener extends AbstractSocketAction
{
    private $socket;

    private int $backlog;

    public function setCreatedSocket($socket)
    {
        $this->socket = $socket;
    }

    public function getListenedSocket()
    {
        return $this->socket;
    }

    public function setBacklog(int $backlog)
    {
        $this->backlog = $backlog;
    }

    public function getBacklog()
    {
        return $this->backlog;
    }

    public function make()
    {
        return socket_listen($this->getListenedSocket(), $this->getBacklog());
    }
}
