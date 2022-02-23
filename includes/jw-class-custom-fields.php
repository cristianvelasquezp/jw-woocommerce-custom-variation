<?php


namespace includes;


class Custom_Fields
{
    public function __construct() {
        $this->define_constants();
        $this->includes();

        add_action('acf/settings/url', array($this, 'set_acf_settings_url'));
        add_filter('acf/settings/show_admin', array( $this, 'afc_hide_admin'));
        //add_action('acf/init',  array( $this, 'variation_type_field'));
    }

    private function define_constants() {
        $this->define( 'WVC_ACF_PATH', WVC_ABSPATH . 'includes/acf/' );
        $this->define( 'WVC_ACF_URL', plugin_dir_url(WVC_PLUGIN_FILE) . 'includes/acf/' );
    }

    private function includes() {
        include_once WVC_ACF_PATH . 'acf.php';
    }

    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
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

            'key' => 'wvc_attribute_type_color',
            'label' => 'Color',
            'name' => 'wvc_attribute_type_color',
            'type' => 'color_picker',
            'instructions' => 'Select Color',
            'required' => 0,
        );

        acf_add_local_field_group(array(
            'key' => 'group_1',
            'title' => 'BK,Q',
            'fields' => array (
                $select_field
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'taxonomy',
                        'operator' => '==',
                        'value' => 'all',
                    ),
                ),
            ),
        ));
    }
}