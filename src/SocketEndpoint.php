<?php 

namespace WebSocket;

use Websocket\Credential\ICredential;
use WebSocket\SocketMessage;
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
    public function getSocket()
    {
        return new Socket(
            $this->getCredentials()->getCredential('host'),
            $this->getCredentials()->getCredential('port')
        );
    }

    /**
     * Write content from current listening socket
     * @param string $message 
     * @return int 
     */ 
    protected function writeToSocket(string $message)
    {   
        return $this->getSocket()->write($message);
    }

    /**
     * Read content from current listening socket
     * @return string 
     */ 
    protected function readFromSocket()
    {
        return $this->getSocket()->read();
    }

    /**
     * Send message on listening socket and
     * read response from socket
     * @param string $message 
     * @return string 
     */ 
    public function send(string $message)
    {
        if (!$this->writeToSocket($message)) {
            return false;
        }

        return $this->readFromSocket();
    }
}
