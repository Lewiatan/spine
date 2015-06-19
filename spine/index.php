<?php

// Some features to build

use Spine\Spine;

Spine::assemble();

//Spine::addPostType();
//Spine::removePostType();
//
//Spine::addCss();
//Spine::removeCss();
//
//Spine::addJs();
//Spine::removeJs();
//
//Spine::addMetaBox();
//Spine::removeMetaBox();



//$spine->metabox->make();

$metabox = (new Metabox('slug', 'name'))->contex('context');
$metabox->addField('name', 'type')->withLabel('Label');
