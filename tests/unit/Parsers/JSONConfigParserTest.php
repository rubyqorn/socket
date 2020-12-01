<?php 

use PHPUnit\Framework\TestCase;
use Qonsillium\Parsers\ConfigParsersFactory;

class JSONConfigParserTest extends TestCase
{
    public function testParseMethodReturnsArraySettings()
    {
        $factory = new ConfigParsersFactory( dirname(__DIR__, 1) . '/fixtures/config_tcp.json');
        $this->assertIsArray(
            $factory->getParser()->parse(), 
            "JSONConfigParser::parse. Expected type 'array', but getting null"
        );
    }
}
