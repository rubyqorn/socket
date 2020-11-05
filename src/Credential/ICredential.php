<?php 

namespace Qonsillium\Credential;

interface ICredential
{
    /**
     * Set value for specified property name 
     * @param string $name 
     * @param string $value 
     * @return void 
     */ 
    public function setCredential(string $name, string $value);

    /**
     * Get value of property by specified property 
     * name
     * @param string $name
     * @return mixed  
     */ 
    public function getCredential(string $name);
}
