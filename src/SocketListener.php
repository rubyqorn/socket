<?php 

namespace Qonsillium;

class SocketListener extends AbstractSocketAction
{
    /**
     * Created socket 
     * @var resource 
     */ 
    private $socket;

    /**
     * Maximum incoming connections
     * @var int  
     */ 
    private int $backlog;

    /**
     * @param resource $socket 
     * @return void 
     */ 
    public function setCreatedSocket($socket)
    {
        $this->socket = $socket;
    }

    /**
     * @return resource 
     */ 
    public function getListenedSocket()
    {
        return $this->socket;
    }

    /**
     * @param int $backlog
     * @return void 
     */ 
    public function setBacklog(int $backlog)
    {
        $this->backlog = $backlog;
    }

    /**
     * @return int 
     */ 
    public function getBacklog()
    {
        return $this->backlog;
    }

    /**
     * Listen socket connections
     * @return book 
     */ 
    public function make()
    {
        return socket_listen($this->getListenedSocket(), $this->getBacklog());
    }
}
