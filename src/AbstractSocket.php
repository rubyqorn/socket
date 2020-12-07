<?php 

namespace Qonsillium;

abstract class AbstractSocket
{
    /**
     * @var \Qonsillium\SocketFacade|null 
     */ 
    protected ?SocketFacade $facade = null;

    /**
     * Initiate AbstractSocket constructor method 
     * and set SocketFacade property
     * @param \Qonsillium\SocketFacade $facade
     * @return void 
     */ 
    public function __construct(SocketFacade $facade)
    {
        $this->facade = $facade;
    }

    /**
     * Send message on client or server socket
     * @param string $message 
     * @return string|bool 
     */ 
    abstract public function send(string $message);
}
