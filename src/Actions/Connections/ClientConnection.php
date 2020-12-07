<?php 

namespace Qonsillium\Actions\Connections;

class ClientConnection extends Connection
{
    /**
     * Create client connection to server socket 
     * @return resource
     */ 
    public function create()
    {
        return stream_socket_client(
            $this->getAddress(),
            $errno,
            $errstr
        );
    }
}
