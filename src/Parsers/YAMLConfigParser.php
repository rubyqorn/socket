<?php 

namespace Qonsillium\Parsers;

class YAMLConfigParser extends ConfigParser
{
    /**
     * Parse yaml(yml) file with settings and return 
     * it in assoc array interpretation.
     * @return array
     */ 
    public function parse(): array
    {
        return yaml_parse_file($this->file);
    }
}
