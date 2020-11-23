<?php 

namespace Qonsillium\Parsers;

class JSONConfigParser extends ConfigParser
{
    /**
     * Parse json file with settings and return 
     * it in assoc array interpretation.
     * 
     * JSON config file example:
     * {
     *    "settings": {
     *      "domain": "AF_INET",
     *      "type": "SOCK_STREAM",
     *      "protocol": "SOL_TCP",
     *      "host": "127.0.0.1",
     *      "port": "8000",
     *    }
     * } 
     * 
     * @return array
     */ 
    public function parse(): array
    {
        return json_decode(file_get_contents($this->file), true);
    }
}
