<?php 

namespace Qonsillium\Credential;

class SocketCredentials implements ICredential
{
    /**
     * Set credentials for socket connection
     * @param string $name 
     * @param string $value 
     * @return void 
     */ 
    public function setCredential(string $name, string $value)
    {
        $this->$name = $value;
    }

    /**
     * Get credentials for socket connection
     * @param string $name 
     * @return string 
     */ 
    public function getCredential(string $name)
    {
        return $this->$name;
    }

    /**
     * Validate existence of credential
     * @param string $name 
     * @return bool 
     */ 
    public function validateExistence(string $name)
    {
        if (!property_exists($this, $name)) {
            return false;
        }

        return true;
    }
}
