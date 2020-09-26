<?php 

namespace WebSocket;

class Socket 
{
    /**
     * @var string 
     */ 
    protected string $host;

    /**
     * @var string 
     */ 
    protected string $port;

    /**
     * Current listening socket
     * @var resource 
     */ 
    protected $socket;

    /**
     * Readed message from listening
     * socket
     * @var string 
     */ 
    protected string $content;

    /**
     * Socket constructor method
     * @param string $host 
     * @param string $port  
     */ 
    public function __construct(string $host, string $port)
    {
        $this->host = $host;
        $this->port = $port;
        $this->socket = $this->create();
    }

    /**
     * Creates and returns a socket resource, also 
     * referred to as an endpoint of communication 
     * @return resource
     */ 
    public function create()
    {
        return socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    }

    /**
     * Initiates a connection on a socket
     * @return bool 
     */ 
    public function connect()
    {
        return socket_connect(
            $this->socket, $this->host, $this->port
        );
    }

    /**
     * Write to a socket specified message
     * @param string $message 
     * @return int  
     */ 
    public function write(string $message)
    {
        return socket_write(
            $this->socket, $message, strlen($message)
        );
    }

    /**
     * Reads a maximum of length bytes from a socket
     * @return string 
     */ 
    public function read()
    {
        $write = null;
        $exception = null;

        while(socket_select([$this->socket], $write, $exception, 0)) {
            socket_recv(
                $this->socket, $this->content, strlen($this->content), 0
            );
        }

        return $this->content;
    }

    /**
     * Socket detructor method which 
     * close current listening socket 
     */ 
    public function __destruct()
    {
        socket_close($this->socket);
    }
}
