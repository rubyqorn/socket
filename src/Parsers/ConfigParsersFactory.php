<?php 

namespace Qonsillium\Parsers;

class ConfigParsersFactory
{
    /**
     * File extension
     * @var string 
     */ 
    protected string $configFileExtension;

    /**
     * Null object which make stub action.
     * Read: https://en.wikipedia.org/wiki/Null_object_pattern
     * @var \Qonsillium\Parsers\ConfigParser 
     */ 
    protected ConfigParser $nullObj;

    public function __construct(
        protected string $configFile,
    ){
        $this->configFileExtension = pathinfo($this->configFile)['extension'];
        $this->nullObj = new NullConfigFile($this->configFile);
    }

    /**
     * Factory method which return config file 
     * handler by its extension. Can be ONLY
     * yaml(yml) or json
     * @return \Qonsillium\Parsers\ConfigParser 
     */ 
    public function getParser(): ConfigParser
    {
        if ($this->configFileExtension === 'yaml' || $this->configFileExtension === 'yml') {
            return new YAMLConfigParser($this->configFile);
        } elseif ($this->configFileExtension === 'json') {
            return new JSONConfigParser($this->configFile);
        } else {
            return $this->nullObj;
        }        
    }
}
