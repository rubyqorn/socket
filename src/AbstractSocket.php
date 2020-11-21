<?php 

namespace Qonsillium;

use Qonsillium\Credential\SocketCredentials;

abstract class AbstractSocket
{
    protected ?SocketCredentials $credentials = null;

    public function __construct(SocketCredentials $credentials)
    {
        $this->credentials = $credentials;
    }

    abstract public function create();

    abstract public function read();

    abstract public function write();

    abstract public function close();

    public function __destruct()
    {
        $this->close();
    }
}
