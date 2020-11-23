<?php 

namespace Qonsillium;

class SocketReader extends AbstractSocketAction
{
    /**
     * Created or accepted socket
     * @var resource 
     */ 
    private $socket;

    /**
     * Readed message from socket
     * @var string 
     */ 
    private string $message = '';

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
