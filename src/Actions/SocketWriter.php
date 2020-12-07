<?php 

namespace Qonsillium\Actions;

class SocketWriter extends AbstractSocketAction
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
     * Write messages to connected socket
     * @return int 
     */ 
    public function make()
    {
        return fwrite($this->getSocket(), $this->getMessage(), strlen($this->getMessage()));
    }
}
