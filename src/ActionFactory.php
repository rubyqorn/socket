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
     * Returns socket domain setting from config file
     * @return string 
     */ 
    private function getDomain()
    {
        return $this->credentials->getCredential('domain');
    }

    /**
     * Returns socket type setting from config file
     * @return string 
     */ 
    private function getType()
    {
        return $this->credentials->getCredential('type');
    }

    /**
     * Returns socket protocol setting from config file
     * @return string 
     */ 
    private function getProtocol()
    {
        return $this->credentials->getCredential('protocol');
    }

    /**
     * Return setted host or socket file name from 
     * credentials handler
     * @return string 
     */ 
    private function getAddress()
    {
        if ($this->credentials->validateExistence('socket_file')) {
            return $this->credentials->getCredential('socket_file');
        }
        
        return $this->credentials->getCredential('host');
    }

    /**
     * Return setted socket port from
     * credentials handler
     * @return string 
     */ 
    private function getPort()
    {
        if ($this->credentials->validateExistence('port')) {
            return $this->credentials->getCredential('port');
        }

        return 0;
    }

    /**
     * Returns number of incoming backlogs
     * @return int 
     */ 
    private function getBacklog()
    {
        return $this->credentials->getCredential('backlog');
    }

    /**
     * Bytes length which will be fetched from remote host
     * @return int 
     */ 
    private function getReadLength()
    {
        return $this->credentials->getCredential('read_length');
    }

    /**
     * Return flag value responded for reading status
     * @return int
     */ 
    private function getReadFlag()
    {
        return $this->credentials->getCredential('read_flag');
    }

    /**
     * @return \Qonsillium\SocketCreator 
     */ 
    public function getCreator(): SocketCreator
    {
        return new SocketCreator($this->getDomain(), $this->getType(), $this->getProtocol());
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
        return new SocketConnector($this->getAddress(), $this->getPort());
    }

    /**
     * @return \Qonsillium\SocketListener 
     */ 
    public function getListener(): SocketListener
    {
        return new SocketListener($this->getBacklog());
    }

    /**
     * @return \Qonsillium\SocketBinder
     */ 
    public function getBinder(): SocketBinder
    {   
        return new SocketBinder($this->getAddress(), $this->getPort());
    }

    /**
     * @return \Qonsillium\SocketReader 
     */ 
    public function getReader(): SocketReader
    {
        return new SocketReader($this->getReadLength(), $this->getReadFlag());
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
