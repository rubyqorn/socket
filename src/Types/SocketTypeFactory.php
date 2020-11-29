<?php 

namespace Qonsillium\Types;

class SocketTypeFactory
{
    /**
     * Null object
     * @var \Qonsillium\Types\NullSocketType 
     */ 
    private $nullObj;

    /**
     * Initiate SocketTypeFactory and set TypeConfiguration
     * instance. Also set null type object which contain configure
     * stub method
     * @param \Qonsillium\Types\TypeConfiguration $configuration
     * @return void 
     */ 
    public function __construct(TypeConfiguration $configuration)
    {
        $this->configuration = $configuration;
        $this->nullObj = new NullSocketType($this->configuration);
    }

    /**
     * Factory method which return socket by
     * type 
     * @param string $type
     * @return \Qonsillium\Types\SocketType 
     */ 
    public function getSocket(string $type): SocketType
    {
        if ($type === 'tcp') {
            return new TCPSocketType($this->configuration);
        } elseif ($type === 'unix') {
            return new UnixSocketType($this->configuration);
        } else {
            return $this->nullObj;
        }
    }
}
