<?php namespace Spine;

class Spine {
    public static function init() {

    }

    public static function addCss($name, $location, array $dependencies = array(), $media = 'all', $version = '1.0') {
        wp_enqueue_style( $name, $location, $dependencies, $version, $media );
    }

    public static function removeCss($name) {
        wp_dequeue_style($name);
    }

    public static function addJs($name, $location, array $dependencies = array(), $version = '1.0', $footer = true) {
        wp_enqueue_script( $name, $location, $dependencies, $version, $footer );
    }

    public static function removeJs($name) {
        wp_dequeue_script($name);
    }

    public static function addMetaBox() {

    }

    public static function removeMetaBox() {

    }

    public static function addPostType() {

    }

    public static function removePostType(){

    }


}