<?php 

namespace Qonsillium\Actions;

abstract class AbstractSocketAction
{
    /**
     * Make socket action when need
     * to make class like function 
     * @return mixed 
     */ 
    public function __invoke()
    {
        return $this->make();
    }

    /**
     * Make socket action
     * @return mixed 
     */ 
    abstract public function make();
}
