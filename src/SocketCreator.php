<?php 

namespace Qonsillium;

class SocketCreator extends AbstractSocketAction
{
    private $createdSocket;

    public function make()
    {
        $this->createdSocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        return $this;
    }

    public function getCreatedSocket()
    {
        return $this->createdSocket;
    }
}
