<?php 

namespace WebSocket;

interface ISocketImplementer
{
    /**
     * Initiate socket connection 
     */ 
    public function create();

    /**
     * Read message from initiated socket 
     */ 
    public function read();

    /**
     * Write message to initiated socket 
     * @param string $message 
     */ 
    public function write(string $message);
}
