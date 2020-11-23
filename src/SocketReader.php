<?php 

namespace Qonsillium;

class SocketReader extends AbstractSocketAction
{
    private $socket;

    private string $message = '';

    public function setSocket($socket)
    {
        $this->socket = $socket;
    }

    public function getSocket()
    {
        return $this->socket;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function make()
    {
        while(socket_recv($this->getSocket(), $buffer, 2048, 0)) {
            $this->message .= $buffer;
        }

        return $this;
    }
}
