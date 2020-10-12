<?php 

namespace WebSocket;

class Server extends SocketEndpoint implements ISocketImplementer
{
    /**
     * Socket resource created using 
     * acceptSocketConnection method
     * @var resource 
     */ 
    protected $createdSocket;

    /**
     * Accept client socket connection
     * @return resource|\WebSocket\SocketError 
     */ 
    public function create()
    {
        $this->createdSocket = $this->acceptConnectionOnSocket();

        if (!$this->createdSocket) {
            return new SocketError('Can\'t accepted connected socket');
        }

        return $this->createdSocket;
    }

    /**
     * Read message from accepted client socket 
     * @return \WebSocket\SocketError|\WebSocket\SocketMessage 
     */ 
    public function read()
    {
        $socketResponse = new SocketMessage(
            $this->readFromSocket($this->createdSocket)
        );

        if (!$socketResponse->getSocketResponse()) {
            return new SocketError('Can\'t read message from client socket');
        }

        return $socketResponse;
    }

    /**
     * Write message to client accepted socket 
     * @param string $message 
     * @return int|\WebSocket\SocketError 
     */ 
    public function write(string $message)
    {
        $writtenMessage = $this->writeToSocket($this->createdSocket, $message);

        if (!$writtenMessage) {
            return new SocketError('Can\'t write to accepted client socket');
        }

        return $writtenMessage;
    }
}
