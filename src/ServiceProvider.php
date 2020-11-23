<?php 

namespace Qonsillium;

class ServiceProvider extends ServiceContainer
{
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
}
