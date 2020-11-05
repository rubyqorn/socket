<?php 

namespace Qonsillium;

class Client extends SocketEndpoint implements ISocketImplementer
{
    /**
     * Socket resource created using 
     * acceptSocketConnection method
     * @var resource 
     */ 
    protected $createdSocket;

    /**
     * Accept server socket connection
     * @return resource|\Qonsillium\SocketError 
     */ 
    public function create()
    {
        $this->createdSocket = $this->connectToSocket();

        if (!$this->createdSocket) {
            return new SocketError('Can\'t accepted connected socket');
        }

        return $this->createdSocket;
    }

    /**
     * Read message from accepted server socket 
     * @return \Qonsillium\SocketError|\Qonsillium\SocketMessage 
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
     * Write message to server accepted socket 
     * @param string $message 
     * @return int|\Qonsillium\SocketError 
     */ 
    public function write(string $message)
    {
        $writtenMessage = $this->writeToSocket($this->createdSocket, $message);

        if (!$writtenMessage) {
            return new SocketError('Can\'t write to accepted client socket');
        }

        return $writtenMessage;
    }

    /**
     * Call Client destructor method when socket
     * connection was broken
     * @return void
     */ 
    public function __destruct()
    {
        return $this->closeSocketConnection($this->createdSocket);
    }
}
