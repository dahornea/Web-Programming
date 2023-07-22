<?php

class Car{
    public $id;
    public $name;
    public $superherosList;



    function __construct($id, $name, $superherosList){
        $this->id = $id;
        $this->name = $name;
        $this->superherosList = $superherosList;
    }

    function get_id(){
        return $this->id;
    }

    function set_id($id){
        $this->id = $id;
    }

    function get_name(){
        return $this->name;
    }

    function set_name($name){
        $this->name = $name;
    }

    function get_superherosList(){
        return $this->superherosList;
    }

    function set_superherosList($superherosList){
        $this->superherosList = $superherosList;
    }
}