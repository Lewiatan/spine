<?php  namespace Spine\Adapters;

class Wordpress {
    public function addCss($name, $location = '', array $dependencies = array(), $media = 'all', $version = '1.0'){
        return wp_enqueue_style( $name, $location, $dependencies, $version, $media );
    }

    public function removeCss($name) {
        return wp_dequeue_style($name);
    }

    public function addJs($name, $location, array $dependencies = array(), $version = '1.0', $footer = true) {
        return wp_enqueue_script( $name, $location, $dependencies, $version, $footer );
    }

    public function removeJs($name) {
        wp_dequeue_script($name);
    }
}