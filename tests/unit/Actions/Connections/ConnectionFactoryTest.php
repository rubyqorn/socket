<?php 

use PHPUnit\Framework\TestCase;
use Qonsillium\Actions\Connections\Connection;
use Qonsillium\Actions\Connections\ConnectionFactory;

class ConnectionFactoryTest extends TestCase
{
    public function testFactoryReturnsConnectionInstance()
    {
        $factory = new ConnectionFactory();

        $this->assertInstanceOf(Connection::class, $factory->getConnection('server'));
    }
}
