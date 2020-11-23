<?php 

namespace Qonsillium;

class SocketWriter extends AbstractSocketAction
{
    /**
     * Created or accepted socket
     * @var resource 
     */ 
    private $socket;

    /**
     * Message which will be sent
     * on server or client socket
     * @var string 
     */ 
    private string $message;

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
