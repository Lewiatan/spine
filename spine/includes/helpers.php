<?php

function isWoocommerceAvailable() {
    return ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );
}

function arr_get($array, $key, $default = null) {
    if (is_array($array) && isset($array[$key])) return $array[$key];

    return $default;
}