<?php 

namespace Qonsillium\Actions;

use \Socket;

class SocketConnector extends AbstractSocketAction
{
    /**
     * Created socket connection
     * @var resource 
     */ 
    private $socket;

    /**
     * Host name where will
     * be connected
     * @var string 
     */ 
    private string $host;

    /**
     * Socket port where
     * will be connected
     * @var int 
     */ 
    private int $port;

    /**
     * Initiate SocketConnector constructor method and 
     * set socket host and port values 
     * @param string $host 
     * @param int $port 
     * @return void 
     */ 
    public function __construct(string $host, int $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @param \Socket $socket 
     * @return void 
     */ 
    public function setCreatedSocket(Socket $socket)
    {
        $this->socket = $socket;
    }

    /**
     * @return \Socket 
     */ 
    public function getConnectedSocket(): Socket
    {
        return $this->socket;
    }

    /**
     * Connect to created socket and specific host with
     * port 
     * @return bool 
     */ 
    public function make()
    {
        return socket_connect($this->getConnectedSocket(), $this->host, $this->port);
    }
}