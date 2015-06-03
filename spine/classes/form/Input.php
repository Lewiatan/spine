<?php  namespace Spine\Form; 

class Input extends Form {

    /**
     * @var array
     */
    private $type;

    public function __construct($id, $type, array $attributes = []) {
        parent::__construct($id, $attributes);

        $this->type = $type;
    }

    /**
     * @param $attributes
     * @return string
     */
    protected function renderElement($attributes) {
        $html = '<input type="' . $this->type . '" ' . $attributes . ' id="' . $this->id . '" />';

        return $html;
    }
}