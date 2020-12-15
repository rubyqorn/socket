<?php 

namespace Qonsillium\DI;

use ArrayAccess;

class ServiceContainer implements ArrayAccess
{
    /**
     * @var array 
     */ 
    private array $services;

    /**
     * @param string $offset
     * @param \Closure $value 
     * @return void 
     */ 
    public function offsetSet($offset, $value)
    {
        $this->services[$offset] = $value;
    }

    /**
     * @param string $offset
     * @return mixed 
     */ 
    public function offsetGet($offset)
    {
        return $this->services[$offset];
    }

    /**
     * @param string $offset 
     * @return bool 
     */ 
    public function offsetExists($offset)
    {
        return isset($this->services[$offset]);
    }

    /**
     * @param string $offset
     * @return void 
     */ 
    public function offsetUnset($offset)
    {
        unset($this->services[$offset]);
    }

    /**
     * @param \Qonsillium\DI\IServiceProvider $provider
     * @return void 
     */ 
    public function register(IServiceProvider $provider)
    {
        return $provider->register($this);
    }
}
