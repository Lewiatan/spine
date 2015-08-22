<?php  namespace Spine; 

abstract class Vertebra {
    public function make() {
        return new $this;
    }
}