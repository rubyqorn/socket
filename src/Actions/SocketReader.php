<?php 

namespace Qonsillium\Actions;

class SocketReader extends AbstractSocketAction
{
    /**
     * @var string 
     */ 
    private string $message;

    /**
     * @param string $message
     * @return void 
     */ 
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string 
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Read content from connected socket
     * @return \Qonsillium\Actions\SocketReader 
     */ 
    public function make()
    {
        $this->setMessage(fread($this->getSocket(), 2048));
        return $this;
    }
}
