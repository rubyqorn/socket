<?php 

namespace Qonsillium\Actions;

use \Socket;

class SocketListener extends AbstractSocketAction
{
    /**
     * Created socket 
     * @var \Socket 
     */ 
    private ?Socket $socket;

    /**
     * Maximum incoming connections
     * @var int  
     */ 
    private int $backlog;

    /**
     * Initiate SocketListener constructor method and 
     * set backlog paramter
     * @param int $backlog 
     * @return void 
     */ 
    public function __construct(int $backlog = 1)
    {
        $this->backlog = $backlog;
    }

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
     * Listen socket connections
     * @return book 
     */ 
    public function make()
    {
        return socket_listen($this->getListenedSocket(), $this->backlog);
    }
}
