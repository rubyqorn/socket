<?php

use PHPUnit\Framework\TestCase;
use Qonsillium\Parsers\ConfigParsersFactory;
use Qonsillium\Types\TypeConfiguration;

class TypeConfigurationTest extends TestCase
{
    public function testValidateSettingExistenceReturnsBool()
    {
        $factorySettings = new ConfigParsersFactory(dirname(__DIR__, 1) . '/fixtures/config_tcp.yaml');
        $configuration = new TypeConfiguration($factorySettings->getParser()->parse()['settings']);
        $configuration->configure();

        $this->assertTrue(
            $configuration->validateSettingsExistence('address'),
            "TypeConfiguration::validateSettingExistence. Setting 'host' doesn't exists in settings list"
        );
    }

    public function testGetConfigurationSettingReturnsSameString()
    {
        $factorySettings = new ConfigParsersFactory(dirname(__DIR__, 1) . '/fixtures/config_tcp.yaml');
        $configuration = new TypeConfiguration($factorySettings->getParser()->parse()['settings']);
        $configuration->configure();

        $this->assertSame(
            '127.0.0.1',
            $configuration->getConfigurationSetting('address'),
            "TypeConfiguration::getConfigurationSetting. Expected '127.0.0.1', but got not the same string"
        );
    }
}
