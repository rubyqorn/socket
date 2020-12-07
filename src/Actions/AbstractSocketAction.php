<?php 

namespace Qonsillium\Actions;

abstract class AbstractSocketAction
{
    /**
     * Created socket resource
     * @var resource 
     */ 
    protected $socket;

    /**
     * Make socket action when need
     * to make class like function 
     * @return mixed 
     */ 
    public function __invoke()
    {
        return $this->make();
    }

    /**
     * @param resource $socket 
     * @return void 
     */ 
    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    /**
     * @return resource 
     */ 
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * Make socket action
     * @return mixed 
     */ 
    abstract public function make();
}
