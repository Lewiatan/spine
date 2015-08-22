<?php  namespace Spine\Form;

abstract class Form {

    protected $id;
    /**
     * @var array
     */
    private $attributes;
    /**
     * @var array
     */
    private $options;

    public function __construct($id, array $attributes = [], array $options = []) {

        $this->id = $id;
        $this->attributes = $attributes;
        $this->options = $options;
    }

    /**
     * @return string
     */
    protected function getHtmlAttributes() {
        $html = '';

        foreach ($this->attributes as $attribute => $value) {
            $html .= $attribute . '="' . $value .'" ';
        }

        return $html;
    }

    /**
     * @return mixed
     */
    public function render() {
        $html = '';
        $attributes = $this->getHtmlAttributes();

        if ($this->options['before']) {
            $html .= $this->options['before'];
        }

        $html .= $this->renderElement($attributes);

        if ($this->options['after']) {
            $html .= $this->options['after'];
        }

        return $html;
    }

    /**
     * @return mixed
     */
    public function __toString() {
        return $this->render();
    }

    /**
     * @param $attributes
     * @return string
     */
    abstract protected function renderElement($attributes);
}