<?php 

namespace Qonsillium\Parsers;

class JSONConfigParser extends ConfigParser
{
    /**
     * Parse json file with settings and return 
     * it in assoc array interpretation
     * @return array
     */ 
    public function parse(): array
    {
        return json_decode(file_get_contents($this->file), true);
    }
}
