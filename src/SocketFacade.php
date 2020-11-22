<?php 

namespace Qonsillium;

class SocketFacade
{
    private ?ActionFactory $factory = null;

    private $createdSocket;

    public function __construct(ActionFactory $factory)
    {
        $this->factory = $factory;
    }

    protected function createSocket()
    {
        $socket = $this->factory->getCreator()->make();
        $this->createdSocket = $socket->getCreatedSocket();
        return $this->createdSocket;
    }

    protected function bindSocket($socket)
    {
        $binder = $this->factory->getBinder();
        $binder->setSocket($socket);

        return $binder->make();
    }

    protected function listenSocket($socket)
    {
        $listener = $this->factory->getListener();
        $listener->setCreatedSocket($socket);
        $listener->setBacklog(1);

        return $listener->make();
    }

    protected function acceptSocket($socket)
    {
        $acceptor = $this->factory->getAcceptor();
        $acceptor->setAcceptSocket($socket);
        return $acceptor->make();
    }

    protected function connectSocket($socket)
    {
        $connector = $this->factory->getConnector();
        $connector->setCreatedSocket($socket);
        return $connector->make();
    }

    protected function readSocket($socket)
    {
        $reader = $this->factory->getReader();
        $reader->setSocket($socket);
        return $reader->make()->getMessage();
    }

    protected function writeSocket($socket, string $message)
    {
        $writer = $this->factory->getWriter();
        $writer->setSocket($socket);
        $writer->setMessage($message);
        return $writer->make();
    }

    public function sendFromServer($message)
    {
        $this->createSocket();
        $this->bindSocket($this->createdSocket);
        $this->listenSocket($this->createdSocket);
        $accept = $this->acceptSocket($this->createdSocket);
        echo $this->readSocket($accept) . "\n\n\n";
        $this->writeSocket($this->createdSocket, $message);
    }

    public function sendFromClient($message)
    {
        $this->createSocket();
        $this->connectSocket($this->createdSocket);
        echo $this->readSocket($this->createdSocket);
        $this->writeSocket($this->createdSocket, $message);
    }
}
