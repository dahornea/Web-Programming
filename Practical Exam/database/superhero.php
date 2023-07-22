<?php

class SuperHero{
    public $id;
    public $name;
    public $powers;


function __construct($id, $name, $powers){
    $this->id = $id;
    $this->name = $name;
    $this->powers = $powers;
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

function get_powers(){
        return $this->powers;
    }

function set_powers($powers){
        $this->powers = $powers;
    }

}