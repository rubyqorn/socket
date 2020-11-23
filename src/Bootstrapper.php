<?php 

namespace Qonsillium;

use Qonsillium\Parsers\ConfigParsersFactory;
use Qonsillium\Credential\SocketCredentials;

class Bootstrapper
{
    /**
     * Configuration file with 
     * yaml(yml) or json extension
     * @var string 
     */ 
    protected string $configFile;

    /**
     * List with domain, type, protocol,
     * host and port socket settings
     * @var array 
     */ 
    protected array $settings;

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
    public function __construct(string $configFile)
    {
        $this->configFile = $configFile;
        $this->services = new ServiceProvider();
        $this->settings = $this->parseConfigFile();
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
     * Set socket domain, type, protocol, host and port
     * in SocketCredentials instance
     * @return \Qonsillium\Credential\SocketCredentials 
     */ 
    protected function setCredentials()
    {
        $credentials = $this->getCredentialsHandler();
        $credentials->setCredential('domain', $this->settings['settings']['domain']);
        $credentials->setCredential('type', $this->settings['settings']['type']);
        $credentials->setCredential('protocol', $this->settings['settings']['protocol']);
        $credentials->setCredential('host', $this->settings['settings']['host']);
        $credentials->setCredential('port', $this->settings['settings']['port']);
        return $credentials;
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
