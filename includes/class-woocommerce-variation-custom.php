<?php

final class Woocommerce_Variation_Custom
{
    private $version = "1.0.0";
    private static $_instance = null;
    private $attribute_types = array();
    private $attribute_form;

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
        add_action('acf/init',  array( $this, 'variation_type_field'));

        $this->attribute_types[] = new \includes\Attribute_Type_Color();
        $this->attribute_types[] = new \includes\Attribute_Type_Text();
        $this->attribute_form = new \includes\Attribute_Form($this->attribute_types);

    }

    private function define_constants() {
        $this->define( 'WVC_ABSPATH', dirname( WVC_PLUGIN_FILE ) . '/' );
        $this->define( 'WVC_VERSION', $this->version );
        $this->define( 'WVC_ACF_PATH', WVC_ABSPATH . 'includes/acf/' );
        $this->define( 'WVC_ACF_URL', plugin_dir_url(WVC_PLUGIN_FILE) . 'includes/acf/' );
    }

    public function check_requirements() {
        add_action( 'plugins_loaded', array( $this, 'loading_plugin' ) );
    }

    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    private function includes() {
        include_once WVC_ACF_PATH . 'acf.php';

        include_once WVC_ABSPATH . 'includes/jw-class-attribute-type.php';
        include_once WVC_ABSPATH . 'includes/jw-class-attribute-type-color.php';
        include_once WVC_ABSPATH . 'includes/jw-class-attribute-type-text.php';
        include_once WVC_ABSPATH . 'includes/jw-class-attribute-form.php';
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

    function variation_type_field() {
        $select_field = array(

            'key' => 'field_2',
            'label' => 'Type',
            'name' => 'wvc_variation_type',
            'type' => 'select',
            'instructions' => 'Select variation type',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'choices' => array(
                'red'	=> 'Color',
                'text'  => 'Text'
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'placeholder' => '',

        );

        acf_add_local_field_group(array(
            'key' => 'group_1',
            'title' => '',
            'fields' => array (
                $select_field
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'page',
                        'operator' => '==',
                        'value' => 'product_attributes',
                    ),
                ),
            ),
        ));
    }
}