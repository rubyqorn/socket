<?php 

namespace WebSocket;

class Socket 
{
    protected ?ICredential $credential;

    /**
     * DI of SocketCredentials
     * @param ICredential $credential
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
}
