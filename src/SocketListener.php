<?php 

namespace Qonsillium;

use \Socket;

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
     * @param \Socket $socket 
     * @return void 
     */ 
    public function setCreatedSocket(Socket $socket)
    {
        $this->socket = $socket;
    }

    /**
     * @return \Socket 
     */ 
    public function getListenedSocket(): Socket
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
