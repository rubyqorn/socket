<?php 

namespace Qonsillium\Types;

class UnixSocketType extends SocketType
{
    /**
     * Configure Unix socket
     * @return void 
     */ 
    public function configure()
    {
        return $this->configuration->configure();
    }
}
