<?php 

namespace Qonsillium;

use Qonsillium\Credential\SocketCredentials;

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
     * Return setted host name from 
     * credentials handler
     * @return string 
     */ 
    private function getHost()
    {
        return $this->credentials->getCredential('host');
    }

    /**
     * Return setted socket port from
     * credentials handler
     * @return string 
     */ 
    private function getPort()
    {
        return $this->credentials->getCredential('port');
    }

    /**
     * @return \Qonsillium\SocketCreator 
     */ 
    public function getCreator(): SocketCreator
    {
        return new SocketCreator($this->getHost(), $this->getPort());
    }

    /**
     * @return \Qonsillium\SocketAcceptor 
     */ 
    public function getAcceptor(): SocketAcceptor
    {
        return new SocketAcceptor();
    }

    /**
     * @return \Qonsillium\SocketConnector 
     */ 
    public function getConnector(): SocketConnector
    {
        return new SocketConnector($this->getHost(), $this->getPort());
    }

    /**
     * @return \Qonsillium\SocketListener 
     */ 
    public function getListener(): SocketListener
    {
        return new SocketListener();
    }

    /**
     * @return \Qonsillium\SocketBinder
     */ 
    public function getBinder(): SocketBinder
    {
        return new SocketBinder($this->getHost(), $this->getPort());
    }

    /**
     * @return \Qonsillium\SocketReader 
     */ 
    public function getReader(): SocketReader
    {
        return new SocketReader();
    }

    /**
     * @return \Qonsillium\SocketWriter 
     */ 
    public function getWriter(): SocketWriter
    {
        return new SocketWriter();
    }

    /**
     * @return \Qonsillium\SocketCloser 
     */ 
    public function getCloser(): SocketCloser
    {
        return new SocketCloser();
    }
}
