<?php 

namespace Qonsillium;

use Qonsillium\Exceptions\ {
    FailedConnectSocket,
    FailedWriteSocket,
};

class SocketFacade
{
    /**
     * @var \Qonsillium\ActionFactory|null 
     */ 
    private ?ActionFactory $factory = null;

    /**
     * Readed socket content 
     * @var string 
     */ 
    private string $content = '';

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
     * Connect to client or server socket
     * @param string $connectionType (server|client)
     * @return resource
     */ 
    public function connectSocket(string $connectionType)
    {
        $connector = $this->factory->getConnector($connectionType);
        return $connector()->create();
    }

    /**
     * Accept socket connections
     * @param \Socket $socket 
     * @return bool 
     */ 
    protected function acceptSocket($socket)
    {
        $acceptor = $this->factory->getAcceptor();
        $acceptor->setSocket($socket);
        $acceptAction = $acceptor();

        if (!$acceptAction) {
            return false;
        }

        return $acceptAction;
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
    public function closeSocket($socket)
    {
        $closer = $this->factory->getCloser();
        $closer->setSocket($socket);
        return $closer();
    }

    /**
     * This method can be used only with ServerSocket.
     * Here we create, bind, listen, accept, read and
     * write socket
     * @param string $message 
     * @throws \Qonsillium\Exceptions\FailedCconnectSocket
     * @throws \Qonsillium\Exceptions\FailedWriteSocket
     * @return string
     */ 
    public function sendFromServer(string $message)
    {
        $server = $this->connectSocket('server');

        if (!$server) {
            throw new FailedConnectSocket('Failed to connect server socket');
        }

        while ($client = $this->acceptSocket($server)) {
            $written = $this->writeSocket($client, $message);

            if (!$written) {
                throw new FailedWriteSocket('Failed to write to client socket');
            }

            $this->content .= $this->readSocket($client)->getMessage();
            $this->closeSocket($client);
        }

        $this->closeSocket($server);

        return $this->content;
    }

    /**
     * This method can be used only with ClientSocket.
     * Here we create, read and write socket
     * @param string $message 
     * @throws \Qonsillium\Exceptions\FailedConnectSocket
     * @throws \Qonsillium\Exceptions\FailedWriteSocket
     * @throws \Qonsillium\Exceptions\FailedReadSocket 
     * @return string
     */
    public function sendFromClient(string $message)
    {
        $client = $this->connectSocket('client');

        if (!$client) {
            throw new FailedConnectSocket('Failed to connect client socket');
        }

        $written = $this->writeSocket($client, $message);

        if (!$written) {
            throw new FailedWriteSocket('Failed to write to server socket');
        }

        while(!feof($client)) {
            $this->content .= $this->readSocket($client)->getMessage();
        }

        $this->closeSocket($client);

        return $this->content;
    }
}
