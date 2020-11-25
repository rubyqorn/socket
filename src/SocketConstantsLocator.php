<?php 

namespace Qonsillium;

class SocketConstantsLocator
{
    const MODIFIERS = [
        'domain' => [
            'AF_INET' => 2,
            'AF_INET6' => 10,
            'AF_UNIX' => 1
        ],
        'type' => [
            'SOCK_STREAM' => 1,
            'SOCK_DGRAM' => 2,
            'SOCK_SEQPACKET' => 5,
            'SOCK_RAW' => 3,
            'SOCK_RDM' => 4
        ],
        'protocol' => [
            'SOL_TCP' => 6,
            'SOL_UDP' => 17
        ]
    ];
}
