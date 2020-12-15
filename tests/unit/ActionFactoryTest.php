<?php 

use PHPUnit\Framework\TestCase;
use Qonsillium\ActionFactory;
use Qonsillium\Actions\SocketAcceptor;
use Qonsillium\Actions\SocketConnector;
use Qonsillium\Actions\SocketReader;
use Qonsillium\Actions\SocketWriter;
use Qonsillium\Actions\SocketCloser;
use Qonsillium\Credential\SocketCredentials;

class ActionFactoryTest extends TestCase
{
    protected SocketCredentials $credentials;

    protected ActionFactory $factory;

    public function setUp(): void
    {
        $this->credentials = new SocketCredentials;
        $this->credentials->setCredential('host', 'tcp://127.0.0.1:8000');
        $this->credentials->setCredential('content_length', 2048);

        $this->factory = new ActionFactory($this->credentials);
    }

    public function testGetAddressReturnsSameStringAndIsString()
    {
        $this->assertIsString(
            $this->factory->getAddress(),
            'ActionFactory::getAddress is null. Expected string'
        );

        $this->assertSame(
            'tcp://127.0.0.1:8000', 
            $this->factory->getAddress(), 
            'ActionFactory::getAddress expected string with "tcp://127.0.0.1:8000", but getting null'
        );
    }

    public function testGetConnectorReturnsSocketConnectorInstance()
    {
        $this->assertInstanceOf(
            SocketConnector::class,
            $this->factory->getConnector('server'),
            'ActionFactory::getConnector expected type SocketConnector but getting null'
        );
    }

    public function testGetAcceptorReturnsSocketAcceptorInstance()
    {
        $this->assertInstanceOf(
            SocketAcceptor::class,
            $this->factory->getAcceptor(),
            'ActionFactory::getAcceptor expected type SocketAcceptor but getting null'
        );
    }

    public function testGetReaderReturnsSocketReaderInstance()
    {
        $this->assertInstanceOf(
            SocketReader::class,
            $this->factory->getReader(),
            'ActionFactory::getReader expected type SocketReader but getting null'
        );
    }

    public function testGetReaderReturnsSocketWriterInstance()
    {
        $this->assertInstanceOf(
            SocketWriter::class,
            $this->factory->getWriter(),
            'ActionFactory::getWriter expected type SocketWriter but getting null'
        );
    }

    public function testGetReaderReturnsSocketCloserInstance()
    {
        $this->assertInstanceOf(
            SocketCloser::class,
            $this->factory->getCloser(),
            'ActionFactory::getWriter expected type SocketCloser but getting null'
        );
    }

    public function tearDown(): void
    {
        unset($this->credentials);
        unset($this->factory);
    }
}
