<?php


namespace includes;


class Attribute_Type_Text extends Attribute_Type
{

    public function __construct()
    {
        $this->name = 'Text';
        $this->id = 'text';
    }
}