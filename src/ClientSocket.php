<?php 

namespace Qonsillium;

class ClientSocket extends AbstractSocket
{
    public function send(string $message)
    {
        $sendedMessage = $this->facade->sendFromClient($message);

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
