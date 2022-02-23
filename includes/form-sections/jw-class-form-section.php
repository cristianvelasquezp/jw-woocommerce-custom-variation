<?php

namespace includes\formSection;

abstract class Form_Section
{
    protected $fields = array();
    protected $key = '';
    protected $title = '';

    public function render()
    {
        add_action('acf/init', array($this, 'prepare_fields'));
    }

    public function add_field($parameters)
    {
        $this->fields[] = $parameters;
    }

    public function prepare_fields()
    {
        acf_add_local_field_group(array(
            'key' => $this->key,
            'title' => $this->title,
            'fields' => $this->fields,
            'location' => array(
                $this->fields_location()
            ),
        ));
    }

    abstract function fields_location();

    public function add_color_field( $name, $required = 0 ) {
        $this->add_field(array(
            'key' => 'wvc_attribute_type_color22',
            'label' => 'Color',
            'name' => $name,
            'type' => 'color_picker',
            'instructions' => 'Select Color',
            'required' => $required,
        ));
    }
}