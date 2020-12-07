<?php 

namespace Qonsillium;

class ServerSocket extends AbstractSocket
{
    /**
     * Send specific message on client socket
     * and get response from it
     * @param string $message 
     * @return bool|string 
     */ 
    public function send(string $message)
    {
        $sendedMessage = $this->facade->sendFromServer($message);

        if (!$sendedMessage) {
            return false;
        }

        return $sendedMessage;
    }
}
