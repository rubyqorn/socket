<?php 

namespace Qonsillium;

use Qonsillium\Credential\SocketCredentials;
use Qonsillium\Parsers\ConfigParsersFactory;

abstract class ServiceContainer
{
    /**
     * Socket services container
     * @var array 
     */ 
    protected array $container = [
        'socket_credentials' => SocketCredentials::class,
        'client_socket' => ClientSocket::class,
        'server_socket' => ServerSocket::class,
        'config_parser_factory' => ConfigParsersFactory::class,
        'socket_actions_factory' => ActionFactory::class,
        'socket_facade' => SocketFacade::class,
        'socket_constants' => SocketConstantsLocator::class
    ];
}
