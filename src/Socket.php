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
    protected string $content = '';

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
     * Binds a name to a socket
     * @return bool 
     */ 
    public function bind()
    {
        return socket_bind($this->socket, $this->host, $this->port);
    }

    /**
     * Listens for a connection on a socket
     * @return bool 
     */ 
    public function listen()
    {
        return socket_listen($this->socket, 1);
    }

    /**
     * Accept a connection on a socket 
     * @return resource  
     */ 
    public function accept()
    {
        return socket_accept($this->socket);
    }

    /**
     * Bind, listen and return accepted socket
     * connection 
     * @return resource  
     */ 
    public function acceptSocketConnection()
    {
        if (!$this->bind()) {
            return false;
        }

        if (!$this->listen()) {
            return false;
        }
        
        $acceptedSocket = $this->accept();

        if (!$acceptedSocket) {
            return false;
        }

        return $acceptedSocket;
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
     * Write to a socket specified messages
     * @param string $message 
     * @return int  
     */ 
    public function write($socket, string $message)
    {
        return socket_write(
            $socket, $message, strlen($message)
        );
    }

    /**
     * Reads a maximum of length bytes from a socket
     * @param resource $socket
     * @return string 
     */ 
    public function read($socket)
    {
        while(socket_recv($socket, $buffer, 2048, 0)) {
            $this->content .= $buffer;
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
