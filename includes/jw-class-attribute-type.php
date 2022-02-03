<?php


namespace includes;


abstract class Attribute_Type
{
    protected $name;
    protected $id;

    public function get_name(){
        return $this->name;
    }

    public function get_id(){
        return $this->id;
    }
}