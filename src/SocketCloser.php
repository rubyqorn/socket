<?php 

namespace Qonsillium;

class SocketCloser extends AbstractSocketAction
{
    /**
     * Accepted or created socket
     * @var resource  
     */ 
    private $socket;

    /**
     * @param resource $socket 
     * @return void 
     */ 
    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    /**
     * @return resource 
     */
    public function getSocket()
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
