<?php 

namespace Qonsillium\Actions;

class SocketReader extends AbstractSocketAction
{
    /**
     * @var string 
     */ 
    private string $message;

    /**
     * @var int 
     */ 
    private int $length;

    /**
     * Initiate SocketReader constructor method 
     * @param int $length 
     * @return void 
     */ 
    public function __construct(int $length)
    {   
        $this->length = $length;
    }

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
        $this->setMessage(fread($this->getSocket(), $this->length));
        return $this;
    }
}
