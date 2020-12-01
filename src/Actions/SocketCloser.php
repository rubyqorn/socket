<?php 

namespace Qonsillium\Actions;

use \Socket;

class SocketCloser extends AbstractSocketAction
{
    /**
     * Accepted or created socket
     * @var \Socket  
     */ 
    private $socket;

    /**
     * @param \Socket $socket 
     * @return void 
     */ 
    public function setSocket(Socket $socket)
    {
        $this->socket = $socket;
    }

    /**
     * @return \Socket 
     */
    public function getSocket(): Socket
    {
        return $this->socket;
    }

    /**
     * Close created or accepted socket connection
     * @return void 
     */ 
    public function make()
    {
        return socket_close($this->getSocket());
    }
}
