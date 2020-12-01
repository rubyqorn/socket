<?php 

namespace Qonsillium;

use Closure;
use Qonsillium\Exceptions\ConfigFileDoesntExists;

class QonsilliumSocket
{
    /**
     * @var \Qonsillium\Bootstrapper 
     */ 
    protected ?Bootstrapper $bootstrapper;

    /**
     * Initiate QonsilliumSocket constructor method,
     * validate config file existence and set Bootstrapper
     * instance. Configuration file extension can be ONLY
     * yaml(yml) or json
     * @param string $configFile
     * @return void 
     */ 
    public function __construct(string $configFile)
    {
        if (!file_exists($configFile)) {
            throw new ConfigFileDoesntExists("{$configFile} doesn't exists");
        }

        $this->bootstrapper = new Bootstrapper($configFile);
    }

    /**
     * Return ClientSocket handler
     * @return \Qonsillium\ClientSocket  
     */ 
    protected function getClientSocket(): ClientSocket
    {
        return $this->bootstrapper->getClientSocket();
    }

    /**
     * Return ServerSocket handler
     * @return \Qonsillium\ServerSocket  
     */ 
    protected function getServerSocket(): ServerSocket
    {
        return $this->bootstrapper->getServerSocket();
    }

    /**
     * Run client socket and handle user
     * setted callback function.
     * @param \Closure $handler
     * 
     * Example:
     * $socket = QonsilliumSocket('config.yml');
     * $socket->runClient(function(ClientSocket $client) {
     *    $client->send('Hello from client');
     * })
     * 
     * @return void
     */ 
    public function runClient(Closure $handler)
    {
        call_user_func($handler($this->getClientSocket()));
    }

    /**
     * Run server socket and handle user
     * setted callback function.
     * @param \Closure $handler
     * 
     * Example:
     * $socket = QonsilliumSocket('config.yml');
     * $socket->runClient(function(ServerSocket $server) {
     *    $server->send('Hello from server');
     * })
     * 
     * @return void
     */
    public function runServer(Closure $handler)
    {
        call_user_func($handler($this->getServerSocket()));
    }
}
