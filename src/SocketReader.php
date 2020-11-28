<?php 

namespace Qonsillium;

use \Socket;

class SocketReader extends AbstractSocketAction
{
    /**
     * Created or accepted socket
     * @var \Socket 
     */ 
    private $socket;

    /**
     * Readed message from socket
     * @var string 
     */ 
    private string $message = '';

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
     * @return string 
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Read messages from createdd or accepted sockets
     * @return \Qonsillium\SocketReader 
     */ 
    public function make()
    {
        while(socket_recv($this->getSocket(), $buffer, 2048, 0)) {
            $this->message .= $buffer;
        }

        return $this;
    }
}
