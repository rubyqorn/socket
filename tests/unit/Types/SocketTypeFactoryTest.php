<?php

use PHPUnit\Framework\TestCase;
use Qonsillium\Parsers\ConfigParsersFactory;
use Qonsillium\Types\TypeConfiguration;
use Qonsillium\Types\SocketTypeFactory;
use Qonsillium\Types\SocketType;

class SocketTypeFactoryTest extends TestCase
{
    public function testGetSocketReturnsSocketTypeInstance()
    {
        $factorySettings = new ConfigParsersFactory(dirname(__DIR__, 1) . '/fixtures/config_tcp.yaml');
        $configuration = new TypeConfiguration($factorySettings->getParser()->parse()['settings']);
        $socketTypeFactory = new SocketTypeFactory($configuration);

        // SocketTypeFactory::getSocket will always return SocketType instance
        // that's because we have a null object which contain realize interface of
        // SocketType. Even if we will pass wrong file will be returned null object
        $this->assertInstanceOf(
            SocketType::class,
            $socketTypeFactory->getSocket('tcp')
        );
    }
}
