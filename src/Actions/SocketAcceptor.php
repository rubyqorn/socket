<?php 

namespace Qonsillium\Actions;

class SocketAcceptor extends AbstractSocketAction
{
    /**
     * Accept socket connections
     * @return resource 
     */ 
    public function make()
    {
        return stream_socket_accept($this->getSocket());
    }
}
