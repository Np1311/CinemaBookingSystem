<?php
require('../../model/customer_model.php');
require('../../model/booking_model.php');


$customer = new customer_model;
$booking = new booking_model;

class booking_controller{
    public function getShowingMovie_controller(){
        global $booking;
        $array = $booking -> getShowingMovie();
        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    public function getMovieDetail_controller($bookingID,$phone){
        global $booking;

        $array = $booking -> getMovieDetail($bookingID,$phone);

        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    public function createBookingController($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTiket, $seats, $noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints, $columnSeat, $rowSeat){
        global $booking;
        global $customer;

        if($columnSeat != 0 && $rowSeat != NULL && $phone != 0){
            $customer -> updateSeat($phone,$columnSeat,$rowSeat);
        }

        if($booking -> createBooking($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTiket, $seats, $noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints)){
            if($phone != 0){
                $booking -> gainPoints($loyaltypoints,$phone);
            }
            
            return true;
        }

    }
    
    public function takenSeats_controller($movieID,$showTiming,$date){
        global $booking;

        $array = $booking->takenSeats($movieID,$showTiming,$date);
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

    public function getBookingController($phone){
        global $booking;

        $array = $booking->getBookingDetail($phone);

        if(count($array)>0){
            return $array;
        }else{
            return false;
        }

    }
    public function redeemPointController($newLoyaltyPoints,$phone){

        global $booking;

        if($booking -> redeemPoint($newLoyaltyPoints,$phone)){
            return true;
        }
    }
    public function getFoodAndDrinkController(){
        global $booking;

        $array = $booking->getFoodAndDrink();

        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    public function orderFoodController($phone,$date,$price,$loyaltypoints){
        global $booking;

        if($booking -> orderFood($phone,$date,$price)){
            $booking ->gainPoints($loyaltypoints,$phone);
            return true;
        }
    }
    public function orderItemController($foodID,$quantity){
        global $booking;

        if($booking -> orderItem($foodID,$quantity)){
            
            return true;
        }
    }

    public function searchMovieController($searchInput){
        global $booking;
        $array = $booking->searchMovie($searchInput);

        if(count($array)>0){
            return $array;
        }
        else {
            return false;
        }
    }
}

$booking_controller = new booking_controller;

// $array = $controller -> takenSeats_controller(2,'12:00 - 14:30');

// var_dump($array);

?>