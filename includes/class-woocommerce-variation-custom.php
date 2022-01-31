<?php

final class Woocommerce_Variation_Custom
{
    private $version = "1.0.0";

    protected static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __constructor() {
        $this->define_constants();
        $this->includes();
    }

    public function check_requirements() {
        add_action( 'plugins_loaded', array( $this, 'loading_plugin' ) );
    }

    private function define_constants() {
        $this->define( 'WVC_ABSPATH', dirname( WC_PLUGIN_FILE ) . '/' );
        $this->define( 'WVC_VERSION', $this->version );
    }

    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    private function includes() {

    }

    public function loading_plugin() {
        try {
            if ( ! is_woocommerce_activated() ) throw new Exception('You need to install woocommerce');
        }catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
        }
    }
}