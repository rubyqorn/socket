<?php 

namespace Qonsillium\Types;

abstract class SocketType
{
    /**
     * Initiate SocketType constructor method and
     * set TypeConfiguration instnace which respond
     * for configuring, validating and getting
     * settings
     * @param \Qonsillium\Types\TypeConfiguration
     * @return void
     */ 
    public function __construct(
        protected TypeConfiguration $configuration
    ){
        //
    }

    /**
     * Validate existence of socket setting
     * @param string $setting
     * @return bool 
     */ 
    public function validate(string $setting)
    {
        if (!$this->configuration->validateSettingsExistence($setting)) {
            return false;
        }

        return true;
    }

    /**
     * Return setting which was setted in
     * configuration file and validate existence
     * @return bool|string 
     */ 
    public function get(string $setting)
    {
        if (!$this->validate($setting)) {
            return false;
        }

        return $this->configuration->getConfigurationSetting($setting);
    }

    /**
     * Configure TCP or Unix socket
     * @return void 
     */ 
    abstract public function configure();
}
