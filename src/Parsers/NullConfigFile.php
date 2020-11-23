<?php 

namespace Qonsillium\Parsers;

class NullConfigFile extends ConfigParser
{
    public function parse(): array
    {
        return [];
    }
}
