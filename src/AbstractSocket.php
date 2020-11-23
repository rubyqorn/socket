<?php 

namespace Qonsillium;

use Qonsillium\Credential\SocketCredentials;

abstract class AbstractSocket
{
    protected ?SocketFacade $facade = null;

    public function __construct(SocketFacade $facade)
    {
        $this->facade = $facade;
    }

    abstract public function send(string $message);

    abstract public function close();

    public function __destruct()
    {
        $this->close();
    }
}
