<?php 

namespace Qonsillium;

use Qonsillium\Parsers\ConfigParsersFactory;
use Qonsillium\Credential\SocketCredentials;
use Qonsillium\Exceptions\ConfigSettingDoesntExists;
use Qonsillium\Types\TypeConfiguration;
use Qonsillium\Types\SocketTypeFactory;

class Bootstrapper
{
    /**
     * List with domain, type, protocol,
     * host and port socket settings
     * @var array 
     */ 
    protected array $settings;

    /**
     * @var \Qonsillium\Types\TypeConfiguration 
     */ 
    protected ?TypeConfiguration $configuration;

    /**
     * @var \Qonsillium\Credential\SocketCredentials 
     */ 
    protected ?SocketCredentials $credentials;

    /**
     * Initiate Bootstrapper constructor method, set and
     * parse config file settings and set this settings
     * in SocketCredentials instance.
     * Configuration file can be ONLY yaml(yml) or json
     * @param string $configFile
     * @return void  
     */ 
    public function __construct(
        protected string $configFile
    ){
        $this->services = new ServiceProvider();
        $this->settings = $this->parseConfigFile();
        $this->configuration = $this->configureSettingsFromFile();
        $this->credentials = $this->setCredentials();
    }

    /**
     * Parse json or yaml(yml) file using using 
     * factory
     * @return array 
     */ 
    protected function parseConfigFile(): array
    {
        return $this->getConfigParserFactory()->getParser()->parse();
    }

    /**
     * Set socket domain, type, protocol, host and port,
     * backlog, read length and backlog, unix socket file
     * and return a SocketCredentials instance. 
     * @throws \Qonsillium\Exceptions\ConfigSettingDoesntExists
     * @return \Qonsillium\Credential\SocketCredentials 
     */ 
    public function setCredentials()
    {
        $credentials = $this->getCredentialsHandler();
        $socketTypeFactory = $this->getSocketTypeFactory();
        $socketType = $socketTypeFactory->getSocket($this->settings['settings']['socket_type']);
        
        // Set socket host credentials. We have only two types
        // It's unix and tcp, another will be ignored
        if ($socketType->get('socket_type') === 'unix') {
            $credentials->setCredential(
                'host', 
                "{$socketType->get('socket_type')}://{$socketType->get('address')}"
            );
        } elseif($socketType->get('socket_type') === 'tcp') {
            $credentials->setCredential(
                'host', 
                "{$socketType->get('socket_type')}://{$socketType->get('address')}:{$socketType->get('port')}"
            );
        }

        $credentials->setCredential(
            'content_length', 
            $socketType->get('content_length')
        );

        return $credentials;
    }

    /**
     * Configure settings from config file by
     * TypeConfiguration and return this instance
     * @return \Qonsillium\Types\TypeConfiguration  
     */ 
    protected function configureSettingsFromFile(): TypeConfiguration
    {
        $configuration = $this->getSocketConfigurator();
        $configuration->configure();
        return $configuration;
    }

    /**
     * Returns TypeConfiguration instance
     * @return \Qonsillium\Types\TypeConfiguration 
     */ 
    public function getSocketConfigurator(): TypeConfiguration
    {
        $configuration = $this->services->getFromList('socket_configuration');
        return new $configuration($this->settings['settings']);
    }

    /**
     * Returns SocketTypeFactory instance
     * @return \Qonsillium\Types\SocketTypeFactory 
     */ 
    public function getSocketTypeFactory(): SocketTypeFactory
    {
        $factory = $this->services->getFromList('socket_type_factory');
        return new $factory($this->configuration);
    }

    /**
     * Returns ConfigParserFactory factory class
     * @return \Qonsillium\Parsers\ConfigParsersFactory
     */ 
    public function getConfigParserFactory(): ConfigParsersFactory
    {
       $configParserFactory = $this->services->getFromList('config_parser_factory');
       return new $configParserFactory($this->configFile);
    }

    /**
     * Returns SocketCredentials class
     * @return \Qonsillium\Credential\SocketCredentials 
     */ 
    public function getCredentialsHandler(): SocketCredentials
    {
        $socketCredentials = $this->services->getFromList('socket_credentials');
        return new $socketCredentials;
    }

    /**
     * Returns ActionFactory factory class
     * @return \Qonsillium\ActionFactory
     */ 
    public function getSocketActionFactory(): ActionFactory
    {
        $actionFactory = $this->services->getFromList('socket_actions_factory');
        return new $actionFactory($this->credentials);
    }

    /**
     * Returns SocketFacade class
     * @return \Qonsillium\SocketFacade
     */ 
    public function getSocketFacade(): SocketFacade
    {
        $socketFacade = $this->services->getFromList('socket_facade');
        return new $socketFacade($this->getSocketActionFactory());
    }

    /**
     * Return ClientSocket class
     * @return \Qonsillium\ClientSocket 
     */ 
    public function getClientSocket(): ClientSocket
    {
        $clientSocket = $this->services->getFromList('client_socket');
        return new $clientSocket($this->getSocketFacade());
    }

    /**
     * Return ServerSocket class
     * @return \Qonsillium\ServerSocket 
     */ 
    public function getServerSocket(): ServerSocket
    {
        $serverSocket = $this->services->getFromList('server_socket');
        return new $serverSocket($this->getSocketFacade());
    }
}
