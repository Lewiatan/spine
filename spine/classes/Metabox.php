<?php  namespace Spine;

class Metabox {
    /**
     * @var array
     */
    private $arguments;
    /**
     * @var array
     */
    private $fields;

    public function __construct(array $arguments, array $fields) {
        $this->arguments = $arguments;
        $this->fields = $fields;

        $this->registerMetabox();
    }

    private function registerMetabox() {
        add_meta_box(
            $this->arguments['id'],
            $this->arguments['title'],
            [$this, 'display'],
            $this->arguments['screen'],
            arr_get($this->arguments, 'context', 'advanced'),
            arr_get($this->arguments, 'priority', 'high')
        );

        add_action('save_post', [$this, 'save']);
    }

    private function display() {
        foreach ($this->fields as $field) {
            $className = ucfirst($field);
            echo new $className;
        }
    }

    private function save() {

    }
}