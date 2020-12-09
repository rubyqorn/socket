<?php 

namespace Qonsillium;

use Qonsillium\Credential\SocketCredentials;
use Qonsillium\Actions\{
    SocketAcceptor,
    SocketCloser,
    SocketConnector,
    SocketReader,
    SocketWriter
};

class ActionFactory
{
    /**
     * @var \Qonsillium\Credential\SocketCredentials|null; 
     */ 
    private ?SocketCredentials $credentials = null;

    /**
     * Initiate ActionFactory constructor method and
     * set SocketCredetials property
     * @param \Qonsillium\Credential\SocketCredentials $credentials
     * @return void 
     */ 
    public function __construct(SocketCredentials $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Returns socket connection address
     * @return string 
     */ 
    public function getAddress()
    {
        return $this->credentials->getCredential('host');
    }

    /**
     * Returns socket read legnth
     * @return int 
     */ 
    private function getReadLength()
    {
        return $this->credentials->getCredential('content_length');
    }

    /**
     * @return \Qonsillium\Actions\SocketConnector 
     */ 
    public function getConnector(string $type)
    {
        return new SocketConnector($this->getAddress(), $type);
    }

    /**
     * @return \Qonsillium\Actions\SocketAcceptor 
     */ 
    public function getAcceptor(): SocketAcceptor
    {
        return new SocketAcceptor();
    }

    /**
     * @return \Qonsillium\Actions\SocketReader 
     */ 
    public function getReader(): SocketReader
    {
        return new SocketReader($this->getReadLength());
    }

    /**
     * @return \Qonsillium\Actions\SocketWriter 
     */ 
    public function getWriter(): SocketWriter
    {
        return new SocketWriter();
    }

    /**
     * @return \Qonsillium\Actions\SocketCloser 
     */ 
    public function getCloser(): SocketCloser
    {
        return new SocketCloser();
    }
}
