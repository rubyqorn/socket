
# Socket

## This is a layer for client and server socket connections.

### PHP extension which have to be installed before to work:
* [PHP 8.0](https://www.php.net/downloads)
* [Yaml](https://www.php.net/manual/en/book.yaml.php)
* [Sockets](https://www.php.net/manual/en/book.sockets.php)

### Four actions you have to make:
* Configure your configuration file.
* Create client.php or server.php file
* Call methods
* Run from CLI or extends

### Examples of TCP and UNIX sockets:

#### 1) Create configuration file. File can be **ONLY** with yaml(yml) or json extensions

##### * TCP socket configuration using YAML
```
settings:
    socket_type: tcp
    address: 127.0.0.1
    port: 8000
    content_length: 2048
```

##### * UNIX socket configuration using YAML
```
settings:
    socket_type: unix
    address: socket.sock
    content_length: 2048
```

#### 2) Create client and server file handlers.

##### server.php
```
<?php

require_once 'vendor/autoload.php';

use Qonsillium\QonsilliumSocket;
use Qonsillium\ServerSocket;

$server = new QonsilliumSocket('config.yaml');
$server->runServer(function(ServerSocket $socket) {
    echo $socket->send('Hello from server!');
});
```

##### client.php
```
<?php

require_once 'vendor/autoload.php';

use Qonsillium\QonsilliumSocket;
use Qonsillium\ClientSocket;

$server = new QonsilliumSocket('config.yaml');
$server->runClient(function(ClinetSocket $socket) {
    echo $socket->send('Hello from client!');
});
```

#### 3) Run from CLI
```
 john@doe:/workdir/$ php server.php
 john@doe:/workdir/$ php client.php
```

#### 4) Extends from QonsilliumSocket
```
<?php 

namespace App;

use Qonsillium\QonsilliumSocket
use Qonillium\ClientSocket

class SocketMessagePrinter extends QonsilliumSocket
{
    public function handleServerSocketMessage(string $myMessage)
    {
        $serverMessage = $this->runClient(function(ClientSocket $client) use ($myMessage) {
            return $client->send($myMessage);
        });

        if ($serverMessage === 'Hello from server!') {
            // handle this action
        }
    }
}
```

But when you will instantiate handler class don't forget to set configuration file with socket settings in constructor method
