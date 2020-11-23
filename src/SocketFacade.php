<?php 

namespace Qonsillium;

use Qonsillium\Exceptions\ {
    FailedAcceptSocket,
    FailedConnectSocket,
    FailedListenSocket,
    FailedCreateSocket,
    FailedWriteSocket,
    FailedCloseSocket,
    FailedBindSocket,
    FailedReadSocket
};

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

        if(!$socket) {
            return false;
        }

        $this->createdSocket = $socket->getCreatedSocket();
        return $this->createdSocket;
    }

    protected function bindSocket($socket)
    {
        $binder = $this->factory->getBinder();
        $binder->setSocket($socket);
        $bindAction = $binder->make();

        if (!$bindAction) {
            return false; 
        }

        return $bindAction;
    }

    protected function listenSocket($socket)
    {
        $listener = $this->factory->getListener();
        $listener->setCreatedSocket($socket);
        $listener->setBacklog(1);
        $listenAction = $listener->make();

        if (!$listenAction) {
            return false;
        }

        return $listenAction;
    }

    protected function acceptSocket($socket)
    {
        $acceptor = $this->factory->getAcceptor();
        $acceptor->setAcceptSocket($socket);
        $acceptAction = $acceptor->make();

        if (!$acceptAction) {
            return false;
        }

        return $acceptAction;
    }

    protected function connectSocket($socket)
    {
        $connector = $this->factory->getConnector();
        $connector->setCreatedSocket($socket);
        $connectionAction = $connector->make();

        if (!$connectionAction) {
            return false;
        }

        return $connectionAction;
    }

    protected function readSocket($socket)
    {
        $reader = $this->factory->getReader();
        $reader->setSocket($socket);
        $readAction = $reader->make();

        if (!$readAction) {
            return false;
        }

        return $readAction;
    }

    protected function writeSocket($socket, string $message)
    {
        $writer = $this->factory->getWriter();
        $writer->setSocket($socket);
        $writer->setMessage($message);
        $writeAction = $writer->make();

        if (!$writeAction) {
            return false;
        }

        return $writeAction;
    }

    public function closeSocket()
    {
        if (!$this->createdSocket) {
            throw new FailedCloseSocket('Failed close, because doesn\'t exists');
        }

        $closer = $this->factory->getCloser();
        $closer->setSocket($this->createdSocket);
        return $closer->make();
    }

    public function sendFromServer($message)
    {
        if (!$this->createSocket()) {
            throw new FailedCreateSocket('Failed to create socket');
        }

        if (!$this->bindSocket($this->createdSocket)) {
            throw new FailedBindSocket('Failed to bind socket');
        }

        if (!$this->listenSocket($this->createdSocket)) {
            throw new FailedListenSocket('Failed to listen socket');
        }

        $accept = $this->acceptSocket($this->createdSocket);

        if (!$accept) {
            throw new FailedAcceptSocket('Failed accept socket');
        }

        if (!$this->writeSocket($accept, $message)) {
            throw new FailedWriteSocket('Failed to write socket');
        }

        $readedSocket = $this->readSocket($accept);

        if (!$readedSocket) {
            throw new FailedAcceptSocket('Failed to write socket');
        }

        return $readedSocket;
    }

    public function sendFromClient($message)
    {
        if (!$this->createSocket()) {
            throw new FailedCreateSocket('Failed to create socket');
        }

        if (!$this->connectSocket($this->createdSocket)) {
            throw new FailedConnectSocket('Failed to connect socket');
        }

        if (!$this->writeSocket($this->createdSocket, $message)) {
            throw new FailedWriteSocket('Failed to write socket');
        }

        $readedSocket = $this->readSocket($this->createdSocket);

        if (!$readedSocket) {
            throw new FailedReadSocket('Failed to read socket');
        }

        return $readedSocket;
    }
}
