<?php 

namespace Qonsillium;

class SocketError
{
    /**
     * Socket error message
     * @var string 
     */ 
    private string $errorMessage;

    /**
     * Initiate constructor method of SocketError
     * @var string $error 
     * @return void
     */ 
    public function __construct(string $error)
    {
        $this->errorMessage = $error;
    }

    /**
     * Return setted socket error
     * @return string 
     */ 
    public function getSocketError()
    {
        return $this->errorMessage;
    }
}
