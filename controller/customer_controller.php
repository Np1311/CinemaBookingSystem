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
    public function getMovieDetail_controller($bookingID,$phone){
        global $customer;

        $array = $customer -> getMovieDetail($bookingID,$phone);

        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    public function createBookingController($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTiket, $seats, $noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints, $columnSeat, $rowSeat){
        global $customer;

        if($columnSeat != 0 && $rowSeat != NULL){
            $customer -> updateSeat($phone,$columnSeat,$rowSeat);
        }

        if($customer -> createBooking($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTiket, $seats, $noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints)){
            return true;
        }

    }
    public function getAccount_controller($profile,$phone){
        global $customer;

        $array = $customer -> getAccount($profile,$phone);

        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    public function updateUserController($profile,$fname,$lname,$phone,$email,$dob,$status,$oldPhone){
        global $customer;

        if($customer -> updateUser($profile,$fname,$lname,$phone,$email,$dob,$status,$oldPhone)){
            return true;
        }
    }
    public function takenSeats_controller($movieID,$showTiming,$date){
        global $customer;

        $array = $customer->takenSeats($movieID,$showTiming,$date);
        if(count($array)>0){ 
            $merged_array = array();
            foreach ($array as $seats) {
                $seats_array = explode(',', $seats);
                $seats_array = array_map('trim', $seats_array); // trim each string in $seats_array
                $merged_array = array_merge($merged_array, $seats_array);
            }
        
            $taken_seats = array();
            foreach ($merged_array as $seat) {
                $row = substr($seat, 0, 1);
                $column = substr($seat, 1);
                if (strlen($seat) > 2) {
                    $row .= trim(substr($seat, 1, 1));
                    $column = substr($seat, 2);
                }
                $taken_seats[] = array('row' => $row, 'column' => $column);
            }
        }else{
            $taken_seats=[];
        }

        return $taken_seats;
    }


}

$controller = new customer_controller;

// $array = $controller -> takenSeats_controller(2,'12:00 - 14:30');

// var_dump($array);

?>