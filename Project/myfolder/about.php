<?php

Class Mobile{

    public $name;
    public $color;

function __construct($model ,$color)
{
    $this->model = $model;
    $this->color = $color;
}


function get_model(){
    return $this->model;
}

function get_color(){
    return $this->color;
}

}
$Apple = new Mobile("Apple x2", "Violet");


print(" Model:". $Apple->get_model());



#check



