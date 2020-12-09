<?php

use PHPUnit\Framework\TestCase;
use Qonsillium\Parsers\ConfigParser;
use Qonsillium\Parsers\ConfigParsersFactory;

class ConfigParserFactory extends TestCase
{
    public function testGetParserReturnsConfigParserInstance()
    {
        $factory = new ConfigParsersFactory(dirname(__DIR__, 1) . '/fixtures/config_tcp.json');
        
        // ConfigParserFactory::getParser will always return ConfigParser instance
        // that's because we have a null object which contain realize interface of
        // ConfigParser. Even if we will pass wrong file will be returned null object
        $this->assertInstanceOf(
            ConfigParser::class, 
            $factory->getParser(),
            'ConfigParserFactory::getParser, Expected type ConfigParser, but getting null'
        );
    }
}
