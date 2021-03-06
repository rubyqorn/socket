<?php 

namespace Qonsillium\Parsers;

abstract class ConfigParser
{
    /**
     * Initiate ConfigParser constructor method.
     * Configuration file can be only with json
     * or yaml(yml) extensions
     * @param string $file
     * @return void  
     */ 
    public function __construct(
        protected string $file
    ){
        //   
    }

    /**
     * Parse configuraton files using PHP
     * yaml and json extensions
     * @return array 
     */ 
    abstract public function parse(): array;
}
