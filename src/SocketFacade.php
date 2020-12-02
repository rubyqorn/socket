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
use \Socket;

class SocketFacade
{
    /**
     * @var \Qonsillium\ActionFactory|null 
     */ 
    private ?ActionFactory $factory = null;

    /**
     * Created socket by socket_create
     * @var \Socket 
     */ 
    private $createdSocket;

    /**
     * Initiate SocketFacade constructor method and
     * set socket actions factory
     * @param \Qonsillium\ActionFactory $factory
     * @return void 
     */ 
    public function __construct(ActionFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Create socket. While can create only
     * TCP socket
     * @return bool|\Socket 
     */ 
    protected function createSocket()
    {
        $socket = $this->factory->getCreator()();

        if(!$socket) {
            return false;
        }

        $this->createdSocket = $socket->getCreatedSocket();
        return $this->createdSocket;
    }

    /**
     * Bind socket host and port
     * @param \Socket $socket 
     * @return bool 
     */ 
    protected function bindSocket($socket)
    {
        $binder = $this->factory->getBinder();
        $binder->setSocket($socket);
        $bindAction = $binder();

        if (!$bindAction) {
            return false; 
        }

        return $bindAction;
    }

    /**
     * Listen socket connections
     * @param \Socket $socket 
     * @return bool 
     */ 
    protected function listenSocket($socket)
    {
        $listener = $this->factory->getListener();
        $listener->setCreatedSocket($socket);
        $listenAction = $listener();

        if (!$listenAction) {
            return false;
        }

        return $listenAction;
    }

    /**
     * Accept socket connections
     * @param \Socket $socket 
     * @return bool 
     */ 
    protected function acceptSocket($socket)
    {
        $acceptor = $this->factory->getAcceptor();
        $acceptor->setAcceptSocket($socket);
        $acceptAction = $acceptor();

        if (!$acceptAction) {
            return false;
        }

        return $acceptAction;
    }

    /**
     * Connect to created socket 
     * @param \Socket $socket 
     * @return bool 
     */ 
    protected function connectSocket($socket)
    {
        $connector = $this->factory->getConnector();
        $connector->setCreatedSocket($socket);
        $connectionAction = $connector();

        if (!$connectionAction) {
            return false;
        }

        return $connectionAction;
    }

    /**
     * Accepts arrays of sockets and waits for them 
     * to change status
     * @param \Socket $socket 
     * @return int 
     */ 
    public function selectSocket($socket)
    {
        $selector = $this->factory->getSelector();
        $selector->setSocket($socket);

        return $selector();
    }

    /**
     * Read messages from client or server sockets
     * @param \Socket $socket 
     * @return bool|\Qonsillium\SocketReader 
     */ 
    protected function readSocket($socket)
    {
        $reader = $this->factory->getReader();
        $reader->setSocket($socket);
        $readAction = $reader();

        if (!$readAction) {
            return false;
        }

        return $readAction;
    }

    /**
     * Write messages on client or server sockets
     * @param \Socket $socket 
     * @param string $message 
     * @return bool|int 
     */ 
    protected function writeSocket($socket, string $message)
    {
        $writer = $this->factory->getWriter();
        $writer->setSocket($socket);
        $writer->setMessage($message);
        $writeAction = $writer();

        if (!$writeAction) {
            return false;
        }

        return $writeAction;
    }

    /**
     * Close accepted or created socket connections
     * @throws \Qonsillium\Exceptions\FailedCloseSocket
     * @return void 
     */ 
    public function closeSocket()
    {
        if (!$this->createdSocket) {
            throw new FailedCloseSocket('Failed close, because doesn\'t exists');
        }

        $closer = $this->factory->getCloser();
        $closer->setSocket($this->createdSocket);
        return $closer();
    }

    /**
     * This method can be used only with ServerSocket.
     * Here we create, bind, listen, accept, read and
     * write socket
     * @param string $message 
     * @throws \Qonsillium\Exceptions\FailedCreateSocket
     * @throws \Qonsillium\Exceptions\FailedBindSocket
     * @throws \Qonsillium\Exceptions\FailedListenSocket
     * @throws \Qonsillium\Exceptions\FailedAcceptSocket
     * @throws \Qonsillium\Exceptions\FailedWriteSocket
     * @throws \Qonsillium\Exceptions\FailedReadSocket 
     * @return \Qonsillium\SocketReader
     */ 
    public function sendFromServer(string $message)
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

        $readedSocket = false;

        while ($this->selectSocket($accept)) {
            $readedSocket = $this->readSocket($accept);
        }

        return $readedSocket;
    }

    /**
     * This method can be used only with ClientSocket.
     * Here we create, read and write socket
     * @param string $message 
     * @throws \Qonsillium\Exceptions\FailedCreateSocket
     * @throws \Qonsillium\Exceptions\FailedConnectSocket
     * @throws \Qonsillium\Exceptions\FailedWriteSocket
     * @throws \Qonsillium\Exceptions\FailedReadSocket 
     * @return \Qonsillium\SocketReader
     */
    public function sendFromClient(string $message)
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

        $readedSocket = false;

        while ($this->selectSocket($this->createdSocket)) {
            $readedSocket = $this->readSocket($this->createdSocket);
        }

        return $readedSocket;
    }
}
