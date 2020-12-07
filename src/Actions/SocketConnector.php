<?php 

namespace Qonsillium\Actions;

use Qonsillium\Actions\Connections\ConnectionFactory;

class SocketConnector extends AbstractSocketAction
{
    /**
     * @var string 
     */ 
    private string $address;

    /**
     * @var string 
     */ 
    private string $type;

    /**
     * Initiate SocketConnector constructor method
     * @param string $method
     * @param string $type
     * @return void 
     */ 
    public function __construct(string $address, string $type)
    {
        $this->address = $address;
        $this->type = $type;
    }

    /**
     * Create client or server socket connection
     * @return \Qonsillium\Actions\Connections\Connection
     */ 
    public function make()
    {
        $connection = ConnectionFactory::getConnection($this->type);
        $connection->setAddress($this->address);
        return $connection;
    }
}
