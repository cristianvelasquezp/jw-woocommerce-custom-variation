<?php

namespace includes\formSection;

class Form_Attribute_Section extends Form_Section
{
    protected $attribute_type;

    public function fields_location() {
        $fields_location = array();
        foreach ($this->get_attribute_taxonomies() as $attribute) {
            $slug = $this->get_attribute_slug($attribute->attribute_id);
            if($attribute->attribute_type == $this->attribute_type) {
                $fields_location[] = array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => $slug,
                );
            }
        }

        return $fields_location;
    }

    private function get_attribute_taxonomies(): array
    {
        return wc_get_attribute_taxonomies();
    }

    private function get_attribute_slug($id) {
        return $this->get_attribute($id)->slug;
    }

    private function get_attribute($id): ?\stdClass
    {
        return wc_get_attribute($id);
    }

}