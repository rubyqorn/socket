<?php 

namespace Qonsillium;

use Qonsillium\Credential\SocketCredentials;

class ActionFactory
{
    private ?SocketCredentials $credentials = null;

    public function __construct(SocketCredentials $credentials)
    {
        $this->credentials = $credentials;
    }

    private function getHost()
    {
        return $this->credentials->getCredential('host');
    }

    private function getPort()
    {
        return $this->credentials->getCredential('port');
    }

    public function getCreator()
    {
        return new SocketCreator($this->getHost(), $this->getPort());
    }

    public function getAcceptor()
    {
        return new SocketAcceptor();
    }

    public function getConnector()
    {
        return new SocketConnector($this->getHost(), $this->getPort());
    }

    public function getListener()
    {
        return new SocketListener();
    }

    public function getBinder()
    {
        return new SocketBinder($this->getHost(), $this->getPort());
    }

    public function getReader()
    {
        return new SocketReader();
    }

    public function getWriter()
    {
        return new SocketWriter();
    }

    public function getCloser()
    {
        return new SocketCloser();
    }
}
