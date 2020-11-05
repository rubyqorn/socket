<?php 

namespace Qonsillium;

use Qonsillium\Client;
use Qonsillium\Server;
use Qonsillium\Socket;
use Qonsillium\SocketEndpoint;
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
     * Validate availablility of Server socket layer
     * and return instance of this class
     * @return \Qonsillium\Server 
     */ 
    public function serverSocketHandler(): Server
    {
        $service = $this->validateServiceExistence('server_socket');

        if (!$service) {
            return false;
        }

        return new $service();
    }

    /**
     * Validate availablility of Client socket layer
     * and return instance of this class
     * @return \Qonsillium\Client 
     */ 
    public function clientSocketHandler(): Client
    {
        $service = $this->validateServiceExistence('client_socket');

        if (!$service) {
            return false;
        }

        return new $service();
    }

    /**
     * Validate availablility of Socket layer
     * and return instance of this class
     * @return \Qonsillium\Socket 
     */ 
    public function socketLayerHandler(): Socket
    {
        $service = $this->validateServiceExistence('socket_layer');

        if (!$service) {
            return false;
        }

        return new $service();
    }

    /**
     * Validate availablility of SocketEndpoint layer
     * and return instance of this class
     * @return \Qonsillium\SocketEndpoint 
     */ 
    public function socketsManagerHandler(): SocketEndpoint
    {   
        $service = $this->validateServiceExistence('socket_endpoint');

        if (!$service) {
            return false;
        }

        return new $service();
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
