<?php 

namespace Qonsillium;

abstract class AbstractSocketAction
{
    public function __invoke()
    {
        return $this->make();
    }

    abstract public function make();
}
