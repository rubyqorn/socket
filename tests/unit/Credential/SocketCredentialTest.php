<?php 

use PHPUnit\Framework\TestCase;
use Qonsillium\Credential\SocketCredentials;

class SocketCredentialTest extends TestCase
{
    public function testGetterMethodReturnsSameProperty()
    {
        $credentials = new SocketCredentials;
        $credentials->setCredential('host', '127.0.0.1');
        
        $this->assertSame('127.0.0.1', $credentials->getCredential('host'));
    }

    public function testPropertyExistenceValidatorReturnsBool()
    {
        $credentials = new SocketCredentials();
        $credentials->setCredential('port', '8001');
        $this->assertTrue(
            $credentials->validateExistence('port'), 
            "SocketCredentials::validateExistence. Expected property 'port', but doesnt exists"
        );
    }
}
