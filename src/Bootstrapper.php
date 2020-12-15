<?php 

namespace Qonsillium;

use Qonsillium\Parsers\ConfigParsersFactory;
use Qonsillium\Credential\SocketCredentials;
use Qonsillium\DI\ServiceContainer;
use Qonsillium\Types\TypeConfiguration;
use Qonsillium\Types\SocketTypeFactory;

class Bootstrapper
{
    /**
     * @var \Qonsillium\SocketServiceProvider 
     */ 
    private SocketServiceProvider $provider;

    /**
     * @var \Qonsillium\DI\ServiceContainer 
     */ 
    private ServiceContainer $container;

    /**
     * Initiate Bootstrapper constructor methoda and register
     * socket service provider.
     * 
     * Configuration file can be ONLY yaml(yml) or json
     * 
     * @param string $configFile
     * @return void  
     */ 
    public function __construct(
        protected string $configFile
    ){
        $this->container = new ServiceContainer();
        $this->provider = new SocketServiceProvider($configFile);
        $this->provider->register($this->container);
    }

    /**
     * @return \Qonsillium\Credential\SocketCredentials 
     */ 
    protected function getSocketCredentials(): SocketCredentials
    {
        return $this->container['credentials.socket']();
    }

    /**
     * @return \Qonsillium\Parsers\ConfigParsersFactory 
     */
    protected function getConfigParsersFactory(): ConfigParsersFactory
    {
        return $this->container['config.parser']();
    }

    /**
     * @return \Qonsillium\Types\TypeConfiguration 
     */
    protected function getSocketTypeConfigurator(): TypeConfiguration
    {
        return $this->container['config.socket_type']();
    }

    /**
     * @return \Qonsillium\ActionFactory 
     */
    protected function getSocketActionsFactory(): ActionFactory
    {
        return $this->container['socket.actions.factory']();
    }

    /**
     * @return \Qonsillium\Types\SocketTypeFactory
     */
    protected function getSocketTypesFactory(): SocketTypeFactory
    {
        return $this->container['socket.types.factory']();
    }

    /**
     * @return \Qonsillium\SocketFacade
     */
    protected function getSocketFacade(): SocketFacade
    {
        return $this->provider['socket.facade'];
    }

    /**
     * @return \Qonsillium\ClientSocket
     */
    public function getClientSocketConnector(): ClientSocket
    {
        return $this->container['socket.connection.client']();
    }

    /**
     * @return \Qonsillium\ServerSocket
     */
    public function getServerSocketConnector(): ServerSocket
    {
        return $this->container['socket.connection.server']();
    }
}
