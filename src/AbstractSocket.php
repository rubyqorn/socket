<?php 

namespace Qonsillium;

abstract class AbstractSocket
{
    /**
     * Initiate AbstractSocket constructor method 
     * and set SocketFacade property
     * @param \Qonsillium\SocketFacade $facade
     * @return void 
     */
    public function __construct(
        protected SocketFacade $facade
    ){
        //
    }

    /**
     * Send message on client or server socket
     * @param string $message 
     * @return string|bool 
     */ 
    abstract public function send(string $message);
}
