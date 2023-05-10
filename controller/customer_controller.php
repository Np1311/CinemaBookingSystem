<?php
require('../../model/customer_model.php');

$customer = new customer_model;

class customer_controller{
    public function getShowingMovie_controller(){
        global $customer;
        $array = $customer -> getShowingMovie();
        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    public function getMovieDetail_controller($bookingID){
        global $customer;

        $array = $customer -> getMovieDetail($bookingID);

        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
}

$controller = new customer_controller;
?>