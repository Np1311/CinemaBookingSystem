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
    public function createBookingController($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTicket, $seats, $noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints, $columnSeat, $rowSeat){
        global $booking;
        global $customer;

        if($columnSeat != 0 && $rowSeat != NULL && $phone != 0){
            $customer -> updateSeat($phone,$columnSeat,$rowSeat);
        }

        if($booking -> createBooking($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTicket, $seats, $noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints)){
            if($phone != 0){
                $booking -> gainPoints($loyaltypoints,$phone);
            }
            
            return true;
        }

    }
    
    public function takenSeats_controller($movie,$showTiming,$date,$bookedID){
        global $booking;

        $array = $booking->takenSeats($movie,$showTiming,$date,$bookedID);
        
        return $array;
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
    public function redeemPointController($points,$phone){

        global $booking;

        if($booking -> redeemPoint($points,$phone)){
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
    public function orderFoodController($phone,$date,$price,$loyaltypoints,$orderedFood){
        global $booking;

        if($booking -> orderFood($phone,$date,$price,$orderedFood)){
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

    public function getBookingByID_controller($bookedID){
        global $booking;
        $array = $booking -> getBookingByID($bookedID);
        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    public function getSelectedSeatByID_controller($bookedID){
        global $booking;
        $array = $booking -> getSelectedSeatByID($bookedID);
        return $array;
    }
    public function updateBookingController($bookedID,$numOfTicket,$seats,$noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket,$total_amnt, $loyaltypoints){
        global $booking;

        if($booking->updateBooking($bookedID,$numOfTicket,$seats,$noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket,$total_amnt, $loyaltypoints)){
            return true;
        }else{
            return false;
        }
    }
    public function getBookingsController($phone){
        global $booking;
        $array = $booking -> getBookings($phone);
        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    public function getFoodOrderController($phone){
        global $booking;
        $array = $booking -> getFoodOrder($phone);
        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    public function getFoodAndDrinkByIDController($orderID){
        global $booking;
        $array = $booking -> getFoodAndDrinkByID($orderID);
        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    public function updateOrderFoodController($orderID,$price){
        global $booking;
        if($booking->updateOrderFood($orderID,$price)){
            return true;
        }else{
            return false;
        }
    }
    public function updateOrderItemController($orderID,$foodID,$quantity){
        global $booking;
        if($booking->updateOrderItem($orderID,$foodID,$quantity)){
            return true;
        }else{
            return false;
        }
    }
}

$booking_controller = new booking_controller;

// $array = $controller -> takenSeats_controller(2,'12:00 - 14:30');

// var_dump($array);

?>