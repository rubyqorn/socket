<?php 

use PHPUnit\Framework\TestCase;
use Qonsillium\Credential\SocketCredentials;

class SocketCredentialTest extends TestCase
{
    public function testGetterMethodReturnsSameProperty()
    {
        $credentials = new SocketCredentials;
        $credentials->setCredential('host', 'tcp://127.0.0.1:8000');
        
        $this->assertSame('tcp://127.0.0.1:8000', $credentials->getCredential('host'));
    }

    public function testPropertyExistenceValidatorReturnsBool()
    {
        $credentials = new SocketCredentials();
        $credentials->setCredential('host', 'tcp://127.0.0.1:8000');
        $this->assertTrue(
            $credentials->validateExistence('host'), 
            "SocketCredentials::validateExistence. Expected property 'host', but doesn't exists"
        );
    }
}
