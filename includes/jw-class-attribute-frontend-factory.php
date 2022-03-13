<?php

namespace includes;

class Attribute_Frontend_Factory
{
    private $attribute;

    public function __construct($attribute)
    {
        $this->attribute = $attribute;
        $this->create_attribute_section();
    }

    private function get_attribute(): ?\stdClass
    {
        return wc_get_attribute($this->attribute['id']);
    }

    private function create_attribute_section() {
        $attribute = $this->get_attribute();
        if($attribute->type == 'color') {
            $attribute_color = new \includes\Attribute_Color_Frontend($this->attribute);
            $attribute_color->render();
        }
    }
}