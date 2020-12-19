<?php 

use PHPUnit\Framework\TestCase;
use Qonsillium\DI\ServiceContainer;
use Qonsillium\SocketServiceProvider;

class SocketServiceProviderTest extends TestCase
{
    public function testRegisterReturnsSameRegisteredsConfigFile()
    {
        $configFilePath = dirname(__DIR__) . '/unit/fixtures/config_tcp.yaml';

        $container = new ServiceContainer();
        $provider = new SocketServiceProvider($configFilePath);
        $provider->register($container);

        $this->assertSame(
            $configFilePath,
            $container['config.file'],
            "SocketServiceProvider::register expected {$configFilePath} file, but got wrong" 
        );
    }
}
