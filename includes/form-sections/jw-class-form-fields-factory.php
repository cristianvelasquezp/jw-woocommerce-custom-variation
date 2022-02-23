<?php

namespace includes\formSection;

abstract class Form_Fields_Factory
{
    abstract public function render();

    abstract public function create();
}