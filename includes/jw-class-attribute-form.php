<?php


namespace includes;


class Attribute_Form
{
    private $attribute_types;

    public function __construct( $attribute_types )
    {
        $this->attribute_types = $attribute_types;

        $this->create_types_field();
    }

    public function create_types_field() {
        add_filter('product_attributes_type_selector', array($this, 'add_attribute_type'));
    }

    public function add_attribute_type(): array
    {
        $types = array('select' => __( 'Select', 'woocommerce' ));
        foreach ($this->attribute_types as $attribute_type) {
            $types[$attribute_type->get_id()] = __($attribute_type->get_name(), '');
        }
        return $types;
    }
}