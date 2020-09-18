<?php 

namespace WebSocket\Credential;

class SocketCredentials implements ICredential
{
    /**
     * Host name where will
     * be connected 
     * @var string 
     */ 
    private string $host;

    /**
     * Port for host
     * @var string 
     */ 
    private string $port;

    /**
     * Set credentials for socket connection
     * @param string $name 
     * @param string $value 
     * @return void 
     */ 
    public function setCredential(string $name, string $value)
    {
        $this->$name = $value;
    }

    /**
     * Get credentials for socket connection
     * @param string $name 
     * @return string 
     */ 
    public function getCredential(string $name)
    {
        return $this->$name;
    }
}
