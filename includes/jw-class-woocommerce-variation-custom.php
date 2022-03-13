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
        $this->loading_plugin();
        $this->define_constants();
        $this->includes();

        new \includes\Custom_Fields();
        $attribute_from = new \includes\formSection\Form_Attribute_Field_Factory();
        $attribute_from->render('color');

        $this->attribute_types[] = new \includes\Attribute_Type_Color();
        $this->attribute_types[] = new \includes\Attribute_Type_Text();
        $this->attribute_form = new \includes\Attribute_Form($this->attribute_types);

        add_action('woocommerce_after_variations_table', array($this, 'create_variation'));
    }

    public function create_variation() {
        global $product;
        $attributes = $product->get_attributes();

        foreach ( $attributes as $attribute => $value) {
            new \includes\Attribute_Frontend_Factory($value);
        }


    }

    private function define_constants() {
        $this->define( 'WVC_ABSPATH', dirname( WVC_PLUGIN_FILE ) . '/' );
        $this->define( 'WVC_VERSION', $this->version );
    }

    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    private function includes() {
        include_once WVC_ABSPATH . 'includes/jw-class-custom-fields.php';
        include_once WVC_ABSPATH . 'includes/form-sections/jw-class-form-section.php';
        include_once WVC_ABSPATH . 'includes/form-sections/jw-class-form-attribute-section.php';
        include_once WVC_ABSPATH . 'includes/form-sections/jw-class-form-attribute-color-section.php';
        include_once WVC_ABSPATH . 'includes/form-sections/jw-class-form-attribute-field-factory.php';
        include_once WVC_ABSPATH . 'includes/jw-class-attribute-type.php';
        include_once WVC_ABSPATH . 'includes/jw-class-attribute-type-color.php';
        include_once WVC_ABSPATH . 'includes/jw-class-attribute-type-text.php';
        include_once WVC_ABSPATH . 'includes/jw-class-attribute-form.php';
        include_once WVC_ABSPATH . 'includes/jw-class-attribute-frontend-factory.php';
        include_once WVC_ABSPATH . 'includes/jw-class-attribute-color-forntend.php';
    }

    public function loading_plugin() {
        try {
            if ( ! is_woocommerce_activated() ) throw new Exception('You need to install woocommerce');
        }catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
        }
    }
}

add_action( 'plugins_loaded', array( 'Woocommerce_Variation_Custom', 'instance' ) );