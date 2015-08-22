<?php  namespace Spine\Form; 

use Spine\Factory;

class Field {
    private $name;
    /**
     * @var string
     */
    private $type;
    private $label;


    /**
     * @param string $name
     * @param string $type
     */
    public function __construct($name = '', $type = 'text') {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @param $name
     * @param string $type
     * @return $this
     */
    public function make($name, $type = 'text') {
        return new Field($name, $type);
    }

    /**
     * @param $label
     * @return $this
     */
    public function withLabel($label) {
        $this->label = $label;

        return $this;
    }
}