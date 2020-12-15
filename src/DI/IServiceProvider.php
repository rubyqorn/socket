<?php 

namespace Qonsillium\DI;

interface IServiceProvider
{
    /**
     * Register new service provider
     * @param \Qonsillium\DI\IServiceContainer
     * @return void 
     */ 
    public function register(ServiceContainer $container);
}
