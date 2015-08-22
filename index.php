<?php
require_once 'vendor/autoload.php';

use Spine\Spine;

$spine = Spine::assemble();

$metabox = $spine->metabox->make('slug', 'name')->context('page');
$metabox->addField('name')->withLabel('Name');
$metabox->addField('country', 'select');

$metabox2 = $spine->metabox->make('slug2', 'name2');
//
//

var_dump($metabox, $metabox2);