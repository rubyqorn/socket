<?php 

use PHPUnit\Framework\TestCase;
use WebSocket\Credential\SocketCredentials;
use WebSocket\Socket;

class SocketTest extends TestCase 
{
    public function testDIReturnSocketCredential()
    {
        $socket = new Socket();
        $socket->setCredentials(new SocketCredentials());

        $this->assertInstanceOf(
            \WebSocket\Credential\SocketCredentials::class, 
            $socket->getCredentials()
        );
    }
}
