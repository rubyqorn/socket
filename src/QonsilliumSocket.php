<?php 

namespace Qonsillium;

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
    public function getClientSocket(): ClientSocket
    {
        return $this->bootstrapper->getClientSocket();
    }

    /**
     * Return ServerSocket handler
     * @return \Qonsillium\ServerSocket  
     */ 
    public function getServerSocket(): ServerSocket
    {
        return $this->bootstrapper->getServerSocket();
    }
}
