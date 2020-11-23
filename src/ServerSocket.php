<?php 

namespace Qonsillium;

class ServerSocket extends AbstractSocket
{
    public function send(string $message)
    {
        $sendedMessage = $this->facade->sendFromServer($message);

        if (!$sendedMessage) {
            return false;
        }

        return $sendedMessage->getMessage();
    }

    public function close()
    {
        return $this->facade->closeSocket();
    }
}
