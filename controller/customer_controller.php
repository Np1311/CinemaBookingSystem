<?php
require_once('../../model/customer_model.php');

$customer = new customer_model;

class customer_controller {
    
    // Updates user information
    public function updateUserController($profile, $fname, $lname, $phone, $email, $password, $dob, $status, $oldPhone){
        global $customer;

        if($customer -> updateUser($profile, $fname, $lname, $phone, $email, $password, $dob, $status, $oldPhone)){
            return true;
        }
    }
    
    // Retrieves the account details for a specific profile and phone number
    public function getAccount_controller($profile, $phone){
        global $customer;

        $array = $customer -> getAccount($profile, $phone);

        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    
    // Adds a review for a specific booking, room, and movie
    public function addReviewController($bookingID, $roomID, $movieID, $movieName, $showTiming, $rating, $review){
        global $customer;

        if($customer -> addReview($bookingID, $roomID, $movieID, $movieName, $showTiming, $rating, $review)){
            return true;
        }
    }
}

$controller = new customer_controller;

?>