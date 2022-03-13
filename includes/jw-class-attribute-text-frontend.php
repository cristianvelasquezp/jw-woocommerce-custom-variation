<?php
namespace includes;

class Attribute_Text_Frontend
{
    public $attribute = array();

    public function __construct($attribute){
        $this->attribute = $attribute;
    }

    public function render() {
        $attribute = $this->attribute;
        echo "<div class='jw_attribute'>";
        foreach ($attribute['options'] as $text){
            $term = get_term($text);
            echo "<span data-text='$term->slug' 
                        style='border: 1px solid #000; 
                               display: inline-block;
                               padding: 5px 20px;
                               margin-right: 10px'>$term->name</span>";
        }
        echo "</div>";
    }
}