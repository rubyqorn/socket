<?php 

namespace Qonsillium;

use Qonsillium\Credential\SocketCredentials;

class ServiceContainer
{
    /**
     * @var \Qonsillium\ServicesHelper 
     */ 
    private ?ServicesHelper $helper;

    /**
     * Initialize ServiceContainer constructor
     * method
     * @return void 
     */ 
    public function __construct()
    {
        $this->helper = new ServicesHelper();
    }

    /**
     * Validate service name existence in container
     * @param string $serviceName
     * @return string 
     * @throws \Qonsillium\Exceptions\ServiceNotFound 
     */ 
    private function validateServiceExistence(string $serviceName)
    {
        return $this->helper->validateService($serviceName);
    }

    /**
     * Validate availablility of SocketCredentials layer
     * and return instance of this class
     * @return \Qonsillium\SocketCredentials 
     */ 
    public function socketCredentialsHandler(): SocketCredentials
    {
        $service = $this->validateServiceExistence('socket_credential');

        if (!$service) {
            return false;
        }

        return new $service();
    }

    public function bootstrap()
    {
        //
    }
}
