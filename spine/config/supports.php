<?php

add_theme_support( 'menus' );

add_theme_support( 'post-thumbnails' );

add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
) );

if (isWoocommerceAvailable()) {
    add_theme_support( 'woocommerce' );
}