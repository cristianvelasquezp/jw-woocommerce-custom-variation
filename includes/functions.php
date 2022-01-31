<?php
function is_woocommerce_activated(): bool
{
    if( ! class_exists( 'WooCommerce' ) ) {
        return false;
    }
    return true;
}