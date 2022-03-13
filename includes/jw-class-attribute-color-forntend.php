<?php

namespace includes;

class Attribute_Color_Frontend
{
    public $attribute = array();

    public function __construct($attribute){
        $this->attribute = $attribute;
    }

    public function render() {
        $attribute = $this->attribute;
        foreach ($attribute['options'] as $color){
            $term = get_term($color);
            $Color_hex = get_field( "wvc_attribute_type_color22", $attribute['name'] . '_' . $color );
            echo "<span data-color='$term->slug' 
                        style='border-color: $Color_hex; 
                               background-color: $Color_hex;
                               display: inline-block;
                               width: 20px;
                               height: 20px;
                               margin-right: 10px'></span>";
        }
    }
}