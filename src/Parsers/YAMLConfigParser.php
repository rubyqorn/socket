<?php 

namespace Qonsillium\Parsers;

class YAMLConfigParser extends ConfigParser
{
    /**
     * Parse yaml(yml) file with settings and return 
     * it in assoc array interpretation.
     * 
     * YAML config file example:
     * settings:
     *  domain: "AF_INET"
     *  type: "SOCK_STREAM"
     *  protocol: "SOL_TCP"
     *  host: "127.0.0.1"
     *  port: "8000"
     * 
     * @return array
     */ 
    public function parse(): array
    {
        return yaml_parse_file($this->file);
    }
}
