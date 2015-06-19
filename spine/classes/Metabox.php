<?php  namespace Spine;

use Spine\Form\Field;

class Metabox {
    private $fields;
    private $slug;
    private $name;

    private $context = 'post';
    /**
     * @var
     */
    private $field;

    /**
     * @param Field $field
     */
    public function __construct(Field $field) {
        $this->field = $field;

        return $this;
    }

    /**
     * @param $slug
     * @param $name
     * @return $this
     */
    public function make($slug, $name) {
        $this->slug = $slug;
        $this->name = $name;
        $this->label = $name;

        return $this;
    }

    public function context($context) {
        $this->context = $context;

        return $this;
    }

    public function addField($name, $type = 'text') {
        $field = new $this->field($name, $type);
        $this->fields[] = $field;

        return $field;
    }

}