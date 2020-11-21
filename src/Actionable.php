<?php 

namespace Qonsillium;

interface Actionable
{
    /**
     * Make socket action like create, listen,
     * bind, read, write, close 
     */ 
    public function make();
}
