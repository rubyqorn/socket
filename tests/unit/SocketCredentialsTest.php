<?php 

use PHPUnit\Framework\TestCase;
use WebSocket\Credential\SocketCredentials;

class SocketCredentialsTest extends TestCase
{
    public function testCredentialGetterReturnHost()
    {
        $credential = new SocketCredentials();

        $this->assertInstanceOf(
            \WebSocket\Credential\ICredential::class, 
            $credential
        );

        $credential->setCredential('host', 'localhost');
        
        $this->assertSame(
            $credential->getCredential('host'), 
            'localhost'
        );
    }
}