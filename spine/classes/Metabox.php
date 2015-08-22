<?php  namespace Spine;

use Spine\Adapters\Wordpress;
use Spine\Form\Field;

class Metabox {
    private $fields;
    private $slug;
    private $title;

    private $context = 'post';
    /**
     * @var
     */
    private $field;
    /**
     * @var
     */
    private $wordpress;

    /**
     * @param Field $field
     * @param Wordpress $wordpress
     */
    public function __construct(Field $field, Wordpress $wordpress) {
        $this->field = $field;
        $this->wordpress = $wordpress;

        return $this;
    }

    public function __get($variable) {
        if (isset($this->$variable)) {
            return $this->$variable;
        }

        return false;
    }

    /**
     * @param $slug
     * @param $title
     * @return $this
     */
    public function make($slug, $title) {
        $this->slug = $slug;
        $this->title = $title;

        $this->wordpress->addAction('save_post', [$this, 'save']);

        return $this;
    }

    public function context($context) {
        $this->context = $context;

        return $this;
    }

    public function addField($name, $type = 'text') {

        $field = $this->field->make($name, $type);
        $this->fields[] = $field;

        return $field;
    }

    public function renderForm() {
        echo $this->addNonce();

        echo $this->renderFields();
    }

    private function addNonce() {
        return $this->wordpress->addNonce($this->slug);
    }

    private function renderFields() {
        $html = '';
        foreach ($this->fields as $field) {
            $html .= $field->render();
        }

        return $html;
    }

    public function save() {
        if ($this->isAutosave()) {
            return false;
        }

        if ( ! $this->nonceValid()) {
            return false;
        }

        foreach ($this->fields as $field) {
            $field->save();
        }

        return true;
    }

    private function isAutosave() {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return true;
        }

        return false;
    }

    private function nonceValid() {
        return $this->wordpress->verifyNonce($this->slug);
    }



}