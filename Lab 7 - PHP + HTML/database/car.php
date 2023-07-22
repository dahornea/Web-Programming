<?php

class Car{
    public $id;
    public $model;
    public $horsepower;
    public $fuel_consumption;
    public $price;
    public $color;
    public $age;
    public $mileage;

    function __construct($id, $model, $horsepower, $fuel_consumption, $price, $color, $age, $mileage){
        $this -> id = $id;
        $this -> model = $model;
        $this -> horsepower = $horsepower;
        $this -> fuel_consumption = $fuel_consumption;
        $this -> price = $price;
        $this -> color = $color;
        $this -> age = $age;
        $this -> mileage = $mileage;
    }

    function get_id(){
        return $this -> id;
    }

    function set_id($id){
        $this -> id = $id;
    }

    function get_model(){
        return $this -> model;
    }

    function set_model($model){
        $this -> model = $model;
    }

    function get_horsepower(){
        return $this -> horsepower;
    }

    function set_horsepower($horsepower){
        $this -> horsepower = $horsepower;
    }

    function get_fuel_consumption(){
        return $this -> fuel_consumption;
    }

    function set_fuel_consumption($fuel_consumption){
        $this -> fuel_consumption = $fuel_consumption;
    }

    function get_price(){
        return $this -> price;
    }

    function set_price($price){
        $this -> price = $price;
    }

    function get_color(){
        return $this -> color;
    }

    function set_color($color){
        $this -> color = $color;
    }

    function get_age(){
        return $this -> age;
    }

    function set_age($age){
        $this -> age = $age;
    }

    function get_mileage(){
        return $this -> mileage;
    }

    function set_mileage($mileage){
        $this -> mileage = $mileage;
    }

}