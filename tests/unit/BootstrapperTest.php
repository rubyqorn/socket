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

        // $this->assertSame(
        //     'tcp://127.0.0.1:8000',
        //     $credentials->getCredential('host')
        // );
    }

    public function testGetConfigParsersFactoryReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            ConfigParsersFactory::class, 
            $boostrapper->getConfigParserFactory()
        );
    }

    public function testGetSocketConfiguratorReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            SocketTypeFactory::class, 
            $boostrapper->getSocketTypeFactory()
        );
    }

    public function testGetSocketActionFactoryReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            ActionFactory::class, 
            $boostrapper->getSocketActionFactory()
        );
    }

    public function testGetSocketFacadeReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            SocketFacade::class, 
            $boostrapper->getSocketFacade()
        );
    }

    public function testGetClientSocketReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            ClientSocket::class, 
            $boostrapper->getClientSocket()
        );
    }

    public function testGetServerSocketReturnsSameInstance()
    {
        $boostrapper = new Bootstrapper(dirname(__DIR__). '/unit/fixtures/config_tcp.yaml');

        $this->assertInstanceOf(
            ServerSocket::class, 
            $boostrapper->getServerSocket()
        );
    }
}
