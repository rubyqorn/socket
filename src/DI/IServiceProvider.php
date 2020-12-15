<?php 

namespace Qonsillium\DI;

interface IServiceProvider
{
    public function register(ServiceContainer $container);
}
