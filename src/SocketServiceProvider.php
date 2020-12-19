<?php 

namespace Qonsillium;

use Qonsillium\DI\IServiceProvider;
use Qonsillium\DI\ServiceContainer;
use Qonsillium\Credential\SocketCredentials;
use Qonsillium\Parsers\ConfigParsersFactory;
use Qonsillium\Types\SocketTypeFactory;
use Qonsillium\Types\TypeConfiguration;

class SocketServiceProvider implements IServiceProvider
{
    /**
     * Initiate SocketServiceProvider constructor method
     * @param string $configFile
     * @return void 
     */ 
    public function __construct(
        private string $configFile)
    {
        //
    }

    /**
     * Register socket services
     * @param \Qonsillium\DI\ServiceContainer 
     */ 
    public function register(ServiceContainer $container)
    {
        $container['config.file'] = $this->configFile;

        $container['config.parser'] = function() use ($container) {
            return new ConfigParsersFactory($container['config.file']);
        };

        $container['config.socket_type'] = function() use ($container) {
            return new TypeConfiguration($container['config.parser']()->getParser()->parse());
        };
        
        $container['credentials.socket'] = function() use ($container) {
            $credential = new SocketCredentials();
            $parsedConfig = $container['config.parser']()->getParser()->parse()['settings'];

            // Set socket host credentials. We have only two types
            // It's unix and tcp, another will be ignored
            if ($parsedConfig['socket_type'] === 'unix') {
                $credential->setCredential(
                    'host', 
                    "{$parsedConfig['socket_type']}://{$parsedConfig['address']}"
                );
            } elseif($parsedConfig['socket_type'] === 'tcp') {
                $credential->setCredential(
                    'host', 
                    "{$parsedConfig['socket_type']}://{$parsedConfig['address']}:{$parsedConfig['port']}"
                );
            }

            $credential->setCredential(
                'content_length', 
                $parsedConfig['content_length']
            );

            return $credential;
        };
        
        $container['socket.actions.factory'] = function() use ($container) {
            return new ActionFactory($container['credentials.socket']());
        };

        $container['socket.types.factory'] = function() use ($container) {
            return new SocketTypeFactory($container['config.socket_type']());
        };

        $container['socket.facade'] = function() use ($container) {
            return new SocketFacade($container['socket.actions.factory']());
        };

        $container['socket.connection.client'] = function() use ($container) {
            return new ClientSocket($container['socket.facade']());
        };

        $container['socket.connection.server'] = function() use ($container) {
            return new ServerSocket($container['socket.facade']());
        };
    }
}
