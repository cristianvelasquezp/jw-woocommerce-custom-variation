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

    public function __construct() {
        $this->define_constants();
        $this->includes();

        add_action('acf/settings/url', array($this, 'set_acf_settings_url'));
        add_filter('acf/settings/show_admin', array( $this, 'afc_hide_admin'));
    }

    public function check_requirements() {
        add_action( 'plugins_loaded', array( $this, 'loading_plugin' ) );
    }

    private function define_constants() {
        $this->define( 'WVC_ABSPATH', dirname( WVC_PLUGIN_FILE ) . '/' );
        $this->define( 'WVC_VERSION', $this->version );
        $this->define( 'MY_ACF_PATH', WVC_ABSPATH . 'includes/acf/' );
        $this->define( 'WVC_ACF_URL', plugin_dir_url(WVC_PLUGIN_FILE) . 'includes/acf/' );
    }

    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    private function includes() {
        include_once( MY_ACF_PATH . 'acf.php' );
    }

    public function loading_plugin() {
        try {
            if ( ! is_woocommerce_activated() ) throw new Exception('You need to install woocommerce');
        }catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
        }
    }

    public function set_acf_settings_url( $url ) {
        return WVC_ACF_URL;
    }

    function afc_hide_admin( $show_admin ) {
        return false;
    }
}