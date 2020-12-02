<?php 

namespace Qonsillium\Actions;

use \Socket;

class SocketWriter extends AbstractSocketAction
{
    /**
     * Created or accepted socket
     * @var \Socket 
     */ 
    private ?Socket $socket;

    /**
     * Message which will be sent
     * on server or client socket
     * @var string 
     */ 
    private string $message;

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
     * @param string $message
     * @return void 
     */ 
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string 
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Send specific message on created
     * or accepted socket 
     * @return int|bool 
     */ 
    public function make()
    {
        return socket_write(
            $this->getSocket(), 
            $this->getMessage(), 
            strlen($this->getMessage())
        );
    }
}
