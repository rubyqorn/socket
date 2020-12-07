<?php 

namespace Qonsillium\Actions\Connections;

class ServerConnection extends Connection
{
    /**
     * Create server socket connection 
     * @return resource
     */ 
    public function create()
    {
        return stream_socket_server(
            $this->getAddress(),
            $errno,
            $errstr
        );
    }
}
