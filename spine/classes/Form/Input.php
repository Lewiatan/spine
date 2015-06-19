<?php  namespace Spine\Form; 

class Input {

    public static function text($name, $value = null, $attributes = []){
        return static::renderElement('text', $name, $value, $attributes);
    }


    protected static function renderElement($type, $name, $value = null, $attributes = []) {
        $attributes = static::setAttributes($type, $name, $value);
        $attributes = static::htmlAttributes($attributes);

        $html = '<input ' . $attributes . '/>';

        return $html;
    }

    protected static function setAttributes($type, $name, $value) {
        $attributes['type'] = $type;
        $attributes['name'] = $name;

        if ($value) {
            $attributes['value'] = $value;
        }

        if (! isset($attributes['id'])) {
            $attributes['id'] = $name;
        }

        return $attributes;
    }

    protected static function htmlAttributes($attributes) {
        $attr = '';

        foreach ($attributes as $name => $value) {
            $attr .= $name . '="' . $value . '" ';
        }

        return $attr;
    }
}