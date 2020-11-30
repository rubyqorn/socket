
# Socket

## This is a layer for client and server socket connections.

### PHP extension which have to be installed before to work:
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
    domain: AF_INET
    type: SOCK_STREAM
    protocol: SOL_TCP
    backlog: 1
    host: '127.0.0.1'
    port: '8001'
    read_length: 2048
    read_flag: MSG_WAITALL
```

##### * UNIX socket configuration using YAML
```
settings:
    socket_type: unix
    domain: AF_UNIX
    type: SOCK_STREAM
    protocol: 0
    backlog: 1
    socket_file: socket.sock
    read_length: 2048
    read_flag: MSG_WAITALL
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

## List of available configuration vars:
#### 1) sock_type - Type of socket which will be created.
* tcp
* unix

#### 2) domain - Specifies the protocol family
* AF_INET
* AF_INET6
* AF_UNIX

#### 3) type - Selects the type of communication
* SOCK_STREAM
* SOCK_DGRAM
* SOCK_SEQPACKET
* SOCK_RAW
* SOCK_RDM

#### 3) protocol - Sets the specific protocol within the specified domain to be used when communicating on the returned socket
* SOL_TCP
* SOL_UDP
* 0 (when use unix)

#### 4) backlog - A maximum of backlog incoming connections will be queued for processing
* Number of incoming backlogs (1 or 2 etc.)

#### 5) host - Host name which where will be accepted or created connection. Can be used when if socket is of the AF_INET family
* 127.0.0.1

#### 6) port - The port parameter is only used when binding an AF_INET socket, and designates the port on which to listen for connections.
* from 1024 to 65535

#### 7) socket_file - If the socket is of the AF_UNIX family, the address is the path of a Unix-domain socket. You can create own socket file but you must make that you set correct path and this file have read and write rights. Or you can set random name in work dir and here will be created socket file
* /tmp/socket.sock
* socket.sock

#### 8) read_length - The maximum number of bytes read is specified by the length parameter.
* 2048, 4096 etc

#### 9) read_flag - The flags responded for reading status.
* MSG_OOB
* MSG_PEEK
* MSG_WAITALL
* MSG_DONTWAIT

###### For details you can refer to the [PHP](https://php.net) documentation
