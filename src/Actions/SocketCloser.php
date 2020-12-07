<?php 

namespace Qonsillium\Actions;

class SocketCloser extends AbstractSocketAction
{
    /**
     * Close created socket connections
     * @return void 
     */ 
    public function make()
    {
        return fclose($this->getSocket());
    }
}
