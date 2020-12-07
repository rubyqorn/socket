<?php 

namespace Qonsillium;

class ClientSocket extends AbstractSocket
{
    /**
     * Send specific message on server socket
     * and get response from it
     * @param string $message 
     * @return bool|string 
     */ 
    public function send(string $message)
    {
        $sendedMessage = $this->facade->sendFromClient($message);

        if (!$sendedMessage) {
            return false;
        }

        return $sendedMessage;
    }
}
