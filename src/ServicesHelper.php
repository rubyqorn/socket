<?php 

namespace Qonsillium;

use Qonsillium\Client;
use Qonsillium\Server;
use Qonsillium\Socket;
use Qonsillium\SocketEndpoint;
use Qonsillium\Credential\SocketCredentials;
use Qonsillium\Exceptions\ServiceNotFound;

class ServicesHelper
{
    /**
     * List of services which will be used 
     * in service container
     * @var array 
     */ 
    protected array $container = [
        'client_socket' => Client::class,
        'server_socket' => Server::class,
        'socket_layer' => Socket::class,
        'socket_endpoint' => SocketEndpoint::class,
        'socket_credentials' => SocketCredentials::class
    ];

    /**
     * Register new service in service container. Must set 
     * new service using little descriptive name, but if 
     * you SET service name which already exists this will 
     * delete previous service, and class name which respond for
     * this service
     * @param string $descriptiveName
     * @param string $className
     * @return void 
     */ 
    public function addToList(string $descriptiveName, string $className)
    {
        $this->container[$descriptiveName] = $className;
    }

    /**
     * Return service from services list by unique
     * key 
     * @param string $serviceName
     * @return mixed 
     */ 
    public function getFromList(string $serviceName)
    {
        return $this->container[$serviceName];
    }

    /**
     * Validate service existence and return namespace
     * of this service in string representation or throws
     * exception
     * @param string $serviceName
     * @return string 
     * @throws \Qonsillium\Exceptions\ServiceNotFound 
     */ 
    public function validateService(string $serviceName)
    {
        $service = "\\{$this->getFromList($serviceName)}";

        if (!class_exists($service)) {
            throw new ServiceNotFound("Service with {$serviceName} was not found");
        }

        return $service;
    }

    /**
     * Remove service from services list by unique key
     * @param string $serviceName
     * @return void 
     */ 
    public function removeFromList(string $serviceName)
    {
        unset($this->container[$serviceName]);
    }
}
