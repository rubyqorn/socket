<?php 

namespace Qonsillium\Types;

class TypeConfiguration
{
    /**
     * Settings which was parsed
     * by json_decode or yaml_parse_file
     * @var array 
     */ 
    protected array $settings;

    /**
     * Configured settings
     * @var array 
     */ 
    protected array $configured;

    /**
     * Initiate TypeConfiguration constructor method
     * and set array with settings
     * @param array $settings 
     * @return void 
     */ 
    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Configure TCP or Unix settings
     * @return void 
     */ 
    public function configure()
    {
        foreach($this->settings as $key => $value) {
            $this->configured[$key] = $value;
        }
    }

    /**
     * Validate settings existence in list
     * @param string $setting
     * @return bool 
     */ 
    public function validateSettingsExistence(string $setting)
    {
        if (!isset($this->configured[$setting])) {
            return false;
        }

        return true;
    }

    /**
     * Return configured setting by passsed name 
     * @return string 
     */ 
    public function getConfigurationSetting(string $setting)
    {
        return $this->configured[$setting];
    }
}
