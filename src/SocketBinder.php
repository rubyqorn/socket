<?php 

namespace Qonsillium;

class SocketBinder extends AbstractSocketAction
{
    /**
     * Created socket connection
     * @var resource 
     */ 
    private $socket;

    /**
     * Host name which will be
     * binded 
     * @var string 
     */ 
    private string $host;

    /**
     * Socket port which will be
     * binded
     * @var int 
     */ 
    private int $port;

    /**
     * Initiate SocketBinder onstructo method and
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
     * Bind host and port values with 
     * creatd socket 
     * @return bool 
     */ 
    public function make()
    {
        return socket_bind($this->getSocket(), $this->host, $this->port);
    }
}
