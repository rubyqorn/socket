<?php

use PHPUnit\Framework\TestCase;
use Qonsillium\Parsers\ConfigParsersFactory;

class YAMLConfigParserTest extends TestCase
{
    public function testParseMethodReturnsArraySettings()
    {
        $factory = new ConfigParsersFactory(dirname(__DIR__, 1) . '/fixtures/config_tcp.yaml');
        $this->assertIsArray(
            $factory->getParser()->parse(),
            "YAMLConfigParser::parse. Expected 'array', but getting null"
        );
    }
}
