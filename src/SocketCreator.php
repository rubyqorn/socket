<?php 

namespace Qonsillium;

class SocketCreator extends AbstractSocketAction
{
    /**
     * Socket which was created by
     * socket_create
     * @var resource
     */ 
    private $createdSocket;

    /**
     * Create socket. Lately have to refactor
     * hard coded socket_create parameters
     * @return \Qonsillium\SocketCreator 
     */ 
    public function make()
    {
        // TODO: Resolve hard coded parameters 
        $this->createdSocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        return $this;
    }

    /**
     * @return resource 
     */ 
    public function getCreatedSocket()
    {
        return $this->createdSocket;
    }
}
