<?php


class Form_Attribute_Color_Section extends Form_Attribute_Section {

    public function __construct()
    {
        $this->key = 'group_01';
        $this->title = 'Prueba';
        $this->attribute_type = 'color';

    }

    public function add_fields() {
        $this->add_color_field('wvc_attribute_type_color22');
    }
}