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
        return wp_dequeue_script($name);
    }

    public function addAction($name, $callback, $priority = 10, $accepted_args = 1) {
        return add_action($name, $callback, $priority = 10, $accepted_args = 1);
    }

    public function addNonce($slug) {
        $labels = $this->makeNonceLabel($slug);

        return wp_nonce_field($labels['value'], $labels['name'], true, false);
    }

    public function verifyNonce($slug) {
        $labels = $this->makeNonceLabel($slug);

        return (isset($_POST[$labels['name']]) && wp_verify_nonce($_POST[$labels['name']], $labels[value]));
    }

    private function makeNonceLabel($slug) {
        $part = 'spine_'.$slug;

        return [
            'name' => $part.'_nonce',
            'value' => $part.'_nonce_meta',
        ];
    }
}