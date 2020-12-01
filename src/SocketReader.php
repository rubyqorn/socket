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
     * Bytes length
     * @var int  
     */ 
    private int $length;

    /**
     * Read status
     * @var int 
     */ 
    private int $flag;

    /**
     * Readed message from socket
     * @var string 
     */ 
    private string $message = '';

    public function __construct(int $length, int $flag = 0)
    {
        $this->length = $length;
        $this->flag = $flag;
    }

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
        while(socket_recv($this->getSocket(), $buffer, $this->length, $this->flag)) {
            $this->message .= $buffer;
        }

        return $this;
    }
}
