<?php 

namespace Qonsillium\Actions\Connections;

class ConnectionFactory
{
    /**
     * Get server or client connection creator
     * @param string $type
     * @return \Qonsillium\Actions\Connections\Connection
     */ 
    public static function getConnection(string $type): Connection
    {
        if ($type === 'server') {
            return new ServerConnection();
        } elseif ($type === 'client') {
            return new ClientConnection();
        }
    }
}
