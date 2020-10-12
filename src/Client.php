<?php

namespace WebSocket;

class Client extends SocketEndpoint implements ISocketImplementer
{
    /**
     * Create socket using connectToSocket
     * method
     * @var resource
     */ 
    private $createdSocket;

    /**
     * Create connection for server socket
     * @return resource|\WebSocket\SocketError 
     */ 
    public function create()
    {
        $this->createdSocket = $this->connectToSocket();

        if (!$this->createdSocket) {
            return new SocketError('Can\'t create and connect to socket');
        }

        return $this->createdSocket;
    }

    /**
     * Read message from created server socket
     * @return \WebSocket\SocketError|WebSocket\SocketMessage 
     */ 
    public function read()
    {
        $responseFromSocket = new SocketMessage(
            $this->readFromSocket($this->createdSocket)
        );

        if (!$responseFromSocket->getSocketResponse()) {
            return new SocketError('Can\'t read from server socket');
        }

        return $responseFromSocket;
    }

    /**
     * Write message to created server socket
     * @param string $message
     * @return int|\WebSocket\SocketError 
     */ 
    public function write(string $message)
    {
        $writtenSocket = $this->write($message);

        if (!$writtenSocket) {
            return new SocketError('Can\'t write to server socket');
        }

        return $writtenSocket;
    }
}
