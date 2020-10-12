<?php 

namespace WebSocket;

use Websocket\Credential\ICredential;
use WebSocket\Socket;

class SocketEndpoint 
{
    protected ?ICredential $credential;

    /**
     * DI of SocketCredentials
     * @param \Websocket\Credential\ICredential $credential
     * @return void 
     */ 
    public function setCredentials(ICredential $credential)
    {
        $this->credential = $credential;
    }

    /**
     * Return instance of SocketCredentials
     * @return SocketCredentials
     */ 
    public function getCredentials()
    {
        return $this->credential;
    }

    /**
     * Socket factory method which manipulate
     * PHP socket API
     * @return \WebSocket\Socket 
     */ 
    protected function getSocket()
    {
        return new Socket(
            $this->getCredentials()->getCredential('host'),
            $this->getCredentials()->getCredential('port')
        );
    }

    /**
     * Bind, listen and accept connection on socket.
     * Usually use when wanted to create server socket 
     * @return resource|bool
     */ 
    protected function acceptConnectionOnSocket()
    {
        return $this->getSocket()->acceptSocketConnection();
    }

    /**
     * Connect to created to socket. Usually use
     * when wanted to create client socket
     * @return resource|bool
     */ 
    protected function connectToSocket()
    {
        return $this->getSocket()->connect()->getConnectedSocket();
    }

    /**
     * Write content from current listening socket
     * @param resource $socket 
     * @param string $message 
     * @return int
     */ 
    protected function writeToSocket($socket, string $message)
    {   
        return $this->getSocket()->write($socket, $message);
    }

    /**
     * Read content from current listening socket
     * @param resource $socket
     * @return string
     */ 
    protected function readFromSocket($socket)
    {
        return $this->getSocket()->read($socket);
    }
}
