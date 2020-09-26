<?php 

namespace WebSocket;

class SocketMessage
{
    protected $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }
}
