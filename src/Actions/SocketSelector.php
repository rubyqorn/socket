<?php 

namespace Qonsillium\Actions;

use \Socket;

class SocketSelector extends AbstractSocketAction
{
    /**
     * @var \Socket 
     */ 
    private ?Socket $socket;

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
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * Runs the select() system call on the given 
     * arrays of sockets with a specified timeout
     * @return int
     */ 
    public function make()
    {
        $read = [$this->getSocket()];
        $write = null;
        $except = null;

        return socket_select($read, $write, $except, 0);
    }
}
