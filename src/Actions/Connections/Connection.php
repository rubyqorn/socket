<?php 

namespace Qonsillium\Actions\Connections;

abstract class Connection
{
    /**
     * Address where will be connected socket
     * @var string
     */ 
    protected string $address;

    /**
     * Socket connection timeout
     * @var int|null 
     */ 
    protected ?int $timeout = null;

    /**
     * @param string $address
     * @return void 
     */ 
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string 
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param int $timeout
     * @return void 
     */ 
    public function setTimeout(int $timeout)
    {   
        $this->timeout = $timeout;
    }

    /**
     * @return int 
     */ 
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Create client or server socket connection
     * @return resource 
     */ 
    abstract public function create(); 
}
