<?php
require('../../model/customer_model.php');
require('../../model/booking_model.php');

$customer = new customer_model;
$booking = new booking_model;

class booking_controller{
    // Retrieves the list of movies currently being shown
    public function getShowingMovie_controller(){
        global $booking;
        $array = $booking -> getShowingMovie();
        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    
    // Retrieves the details of a specific movie for a given booking ID and phone number
    public function getMovieDetail_controller($bookingID,$phone){
        global $booking;

        $array = $booking -> getMovieDetail($bookingID,$phone);

        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    
    // Creates a new booking
    public function createBookingController($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTicket, $seats, $noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints, $columnSeat, $rowSeat){
        global $booking;
        global $customer;

        // Update the seat information for the customer
        if($columnSeat != 0 && $rowSeat != NULL && $phone != 0){
            $customer -> updateSeat($phone,$columnSeat,$rowSeat);
        }

        // Create the booking
        if($booking -> createBooking($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTicket, $seats, $noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints)){
            // Gain loyalty points for the customer
            if($phone != 0){
                $booking -> gainPoints($loyaltypoints,$phone);
            }
            
            return true;
        }
    }
    
    // Retrieves the taken seats for a specific movie, show timing, and date
    public function takenSeats_controller($movie,$showTiming,$date,$bookedID){
        global $booking;

        $array = $booking->takenSeats($movie,$showTiming,$date,$bookedID);
        
        return $array;
    }

    // Retrieves the booking details for a specific phone number
    public function getBookingController($phone){
        global $booking;

        $array = $booking->getBookingDetail($phone);

        if(count($array)>0){
            return $array;
        }else{
            return false;
        }

    }
    
    // Redeems loyalty points for a customer
    public function redeemPointController($points,$phone){

        global $booking;

        if($booking -> redeemPoint($points,$phone)){
            return true;
        }
    }
    
    // Retrieves the list of available food and drink items
    public function getFoodAndDrinkController(){
        global $booking;

        $array = $booking->getFoodAndDrink();

        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }
    
    // Places an order for food and drink items
    public function orderFoodController($phone,$date,$price,$loyaltypoints,$orderedFood){
        global $booking;

        if($booking -> orderFood($phone,$date,$price,$orderedFood)){
            // Gain loyalty points for the customer
            $booking ->gainPoints($loyaltypoints,$phone);
            return true;
        }
    }
    
    // // Adds an item to the food order
    // public function orderItemController($foodID,$quantity){
    //     global $booking;

    //     if($booking -> orderItem($foodID,$quantity)){
    //         return true;
    //     }
    // }

    // Searches for movies based on the given input
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

    // Retrieves the booking details for a specific booking ID
    public function getBookingByID_controller($bookedID){
        global $booking;
        $array = $booking -> getBookingByID($bookedID);
        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }

    // Retrieves the selected seats for a specific booking ID
    public function getSelectedSeatByID_controller($bookedID){
        global $booking;
        $array = $booking -> getSelectedSeatByID($bookedID);
        return $array;
    }

    // Updates the details of a booking
    public function updateBookingController($bookedID,$numOfTicket,$seats,$noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket,$total_amnt, $loyaltypoints){
        global $booking;

        if($booking->updateBooking($bookedID,$numOfTicket,$seats,$noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket,$total_amnt, $loyaltypoints)){
            return true;
        }else{
            return false;
        }
    }

    // Retrieves the list of bookings for a specific phone number
    public function getBookingsController($phone){
        global $booking;
        $array = $booking -> getBookings($phone);
        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }

    // Retrieves the food order for a specific phone number
    public function getFoodOrderController($phone){
        global $booking;
        $array = $booking -> getFoodOrder($phone);
        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }

    // Retrieves the details of a food and drink order for a specific order ID
    public function getFoodAndDrinkByIDController($orderID){
        global $booking;
        $array = $booking -> getFoodAndDrinkByID($orderID);
        if(count($array)>0){
            return $array;
        }else{
            return false;
        }
    }

    // Updates the price of a food order
    public function updateOrderFoodController($orderID,$price,$orderedFood){
        global $booking;
        if($booking->updateOrderFood($orderID,$price,$orderedFood)){
            return true;
        }else{
            return false;
        }
    }
    // Get the booking preview
    public function getBookingPreviewController(){
        global $booking;
        $array = $booking -> getBookingPreview();
      
        return $array;
    }

    // // Updates the item quantity in a food order
    // public function updateOrderItemController($orderID,$foodID,$quantity){
    //     global $booking;
    //     if($booking->updateOrderItem($orderID,$foodID,$quantity)){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
}

$booking_controller = new booking_controller;

// Uncomment the code below if you want to test a specific function

// $array = $booking_controller -> takenSeats_controller(2,'12:00 - 14:30');
// var_dump($array);

?>
