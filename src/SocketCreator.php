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
     * Protocol family to be used 
     * by the socket 
     * @var int
     */ 
    private int $domain;

    /**
     * Type of communication to be 
     * used by the socket 
     * @var int
     */ 
    private int $type;

    /**
     * The specific protocol within the 
     * specified domain to be used when 
     * communicating on the returned socket
     * @var int 
     */ 
    private int $protocol;

    /**
     * Initiate SocketCreator constructor method and
     * set domain, type and socket protocol values
     * @param int $domain 
     * @param int $type 
     * @param int $protocol
     * @return void 
     */ 
    public function __construct(int $domain, int $type, int $protocol)
    {
        $this->domain = $domain;
        $this->type = $type;
        $this->protocol = $protocol;
    }

    /**
     * Create socket. Lately have to refactor
     * hard coded socket_create parameters
     * @return \Qonsillium\SocketCreator 
     */ 
    public function make()
    {
        $this->createdSocket = socket_create($this->domain, $this->type, $this->protocol);
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
