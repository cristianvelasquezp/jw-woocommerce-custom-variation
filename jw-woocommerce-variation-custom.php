<?php
/*
Plugin Name: JW Woocommerce Custom Variation
Plugin URI: https://github.com/cristianvelasquezp/jw-woocommerce-custom-variation
Description:
Version: 1.0
Author: Cristian Velasquez
Author URI: https://github.com/cristianvelasquezp/
License: GPLv2
*/

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WC_PLUGIN_FILE' ) ) {
    define( 'WVC_PLUGIN_FILE', __FILE__ );
}

include_once dirname( WVC_PLUGIN_FILE ) . '/includes/functions.php';

if ( ! class_exists( 'Woocommerce_Variation_Custom', false ) ) {
    include_once dirname( WVC_PLUGIN_FILE ) . '/includes/jw-class-woocommerce-variation-custom.php';
}
