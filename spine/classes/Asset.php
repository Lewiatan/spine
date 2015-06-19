<?php  namespace Spine; 

use Spine\Adapters\Wordpress;

class Asset {

    /**
     * @var Wordpress
     */
    private $wordpress;

    public function __construct(Wordpress $wordpress) {
        $this->wordpress = $wordpress;
    }


    public function addCss($name, $location = '', array $dependencies = array(), $media = 'all', $version = '1.0') {
        if ( ! is_array($name)) {
            $this->$wordpress->addCss($name, $location, $dependencies, $media, $version);
        }

        foreach ($name as $style) {
            $this->addCss($style['name'], $style['location']);
        }
    }

    public function removeCss($name) {
        if ( ! is_array($name)) {
            $this->wordpress->removeCss($name);
        }

        foreach ($name as $style) {
            $this->removeCss($style);
        }
    }

    public function addJs($name, $location, array $dependencies = array(), $version = '1.0', $footer = true) {
        $this->wordpress->addJs($name, $location, $dependencies, $version, $footer);
    }

    public function removeJs($name) {
        $this->wordpress->removeJs($name);
    }
}