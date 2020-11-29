<?php 

namespace Qonsillium\Types;

class TCPSocketType extends SocketType
{
    /**
     * Configure TCP socket
     * @return void 
     */ 
    public function configure()
    {
        return $this->configuration->configure();
    }
}
