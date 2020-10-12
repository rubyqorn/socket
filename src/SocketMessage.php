<?php 

namespace WebSocket;

class SocketMessage
{
    /**
     * Readed socket response
     * @var string 
     */ 
    protected $message;

    /**
     * Socket message constructor method 
     * @param string $message 
     * @return void 
     */ 
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Get current readed socket response 
     * @return string 
     */ 
    public function getSocketResponse()
    {
        return $this->message;
    }
}
