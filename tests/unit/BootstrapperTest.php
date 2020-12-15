<?php 

use PHPUnit\Framework\TestCase;
use Qonsillium\Bootstrapper;
use Qonsillium\Parsers\ConfigParsersFactory;
use Qonsillium\Credential\SocketCredentials;
use Qonsillium\Types\SocketTypeFactory;
use Qonsillium\ActionFactory;
use Qonsillium\ClientSocket;
use Qonsillium\SocketFacade;
use Qonsillium\ServerSocket;

class BootstrapperTest extends TestCase
{
    public function testSetCredentialsReturnsSocketCredentialsInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');
        $credentials = $boostrapper->setCredentials();

        $this->assertInstanceOf(
            SocketCredentials::class,
            $credentials,
            'Bootstrapper::setCredentials returns null, expected SocketCredentials instance'
        );

        $this->assertSame(
            'tcp://127.0.0.1:8000',
            $credentials->getCredential('host'),
            'Bootstrapper::setCredentials, expected "tcp://127.0.0.1:8000" but got not the same string'
        );
    }

    public function testGetConfigParsersFactoryReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            ConfigParsersFactory::class, 
            $boostrapper->getConfigParserFactory(),
            'Bootstrapper::getConfigParserFactory expected type ConfigParsersFactory but getting null'
        );
    }

    public function testGetSocketConfiguratorReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            SocketTypeFactory::class, 
            $boostrapper->getSocketTypeFactory(),
            'Bootstrapper::getSocketTypeFactory expected type SocketTypeFactory but getting null'
        );
    }

    public function testGetSocketActionFactoryReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            ActionFactory::class, 
            $boostrapper->getSocketActionFactory(),
            'Bootstrapper::getSocketActionFactory expected type ActionFactory but getting null'
        );
    }

    public function testGetSocketFacadeReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            SocketFacade::class, 
            $boostrapper->getSocketFacade(),
            'Bootstrapper::getSocketFacade expected type SocketFacade but getting null'
        );
    }

    public function testGetClientSocketReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            ClientSocket::class, 
            $boostrapper->getClientSocket(),
            'Bootstrapper::getClientSocket expected type ClientSocket but getting null'
        );
    }

    public function testGetServerSocketReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            ServerSocket::class, 
            $boostrapper->getServerSocket(),
            'Bootstrapper::getServerSocket expected type getServerSocket but getting null'
        );
    }
}
