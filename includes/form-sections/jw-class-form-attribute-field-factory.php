<?php


class Form_Attribute_Field_Factory
{
    public function render( $type ) {

        $form = $this->create_form_section( $type );
        $form->add_fields();
        $form->render();

    }

    private function create_form_section( $type ): Form_Section
    {
        if ($type = 'color') {
            return new Form_Attribute_Color_Section();
        }
    }
}