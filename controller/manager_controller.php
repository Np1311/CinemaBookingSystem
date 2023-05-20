<?php
require('../../model/manager_model.php');

$manager = new manager_model;

class manager_controller{

    // Creates a new room
    public function createRoomController($roomName, $roomType, $roomCapacity, $totalRow, $totalColumn){
        global $manager;

        if($manager -> createRoom($roomName, $roomType, $roomCapacity, $totalRow, $totalColumn)){
            return true;
        }
    }

    // Retrieves all rooms
    public function viewRoomController(){
        global $manager;

        $arr = $manager -> viewRoom();
        print_r($arr);
        return $arr;
    }

    // Retrieves active rooms
    public function viewActiveRoomController(){
        global $manager;

        $arr = $manager -> viewActiveRoom();
        print_r($arr);
        return $arr;
    }

    // Deletes a room
    public function deleteRoomController($deleteID){
        global $manager;

        if($manager -> deleteRoom($deleteID)){
            return true;
        }
    }

    // Retrieves room details
    public function getRoomDetail($updateID){
        global $manager;

        $array = $manager -> getRoom($updateID);

        return $array;
    }

    // Updates room information
    public function updateRoomController($updateID,$roomName,$roomType,$roomCapacity,$totalRow,$totalColumn,$status){
        global $manager;

        if($manager -> updateRoom($updateID,$roomName,$roomType,$roomCapacity,$totalRow,$totalColumn,$status)){
            return true;
        }
    }

    // Creates a new movie
    public function createMovieController($movieName, $movieBanner, $relDate, $genre, $duration){
        global $manager;

        if($manager -> createMovie($movieName, $movieBanner, $relDate, $genre, $duration)){
            return true;
        }
    }

    // Retrieves all movies
    public function viewMovieController(){
        global $manager;

        $array = $manager -> getMovie();

        return $array;
    }

    // Updates movie information
    public function updateMovieController($updateID, $movieName, $movieBanner, $relDate, $genre, $duration, $status, $roomID, $timing1, $timing2, $timing3, $timing4){
        global $manager;

        if($manager -> updateMovie($updateID, $movieName, $movieBanner, $relDate, $genre, $duration, $status, $roomID, $timing1, $timing2, $timing3, $timing4)){
            return true;
        }
    }

    // Retrieves movie details
    public function getMovieDetail($updateID){
        global $manager;

        $array = $manager -> movieDetail($updateID);

        return $array;
    }

    // Deletes a movie
    public function deleteMovieController($deleteID){
        global $manager;

        if($manager -> deleteMovie($deleteID)){
            return true;
        }
    }

    // Allocates movie to a room
    public function allocateMovieController($movieID, $roomID, $timing1, $timing2, $timing3, $timing4){
        global $manager;

        if($manager -> allocateMovie($movieID, $roomID, $timing1, $timing2, $timing3, $timing4)){
            return true;
        }
    }

    // Creates a new food item
    public function createFoodController($foodName, $description, $price, $category, $stock, $image){
        global $manager;

        if($manager -> createFood($foodName, $description, $price, $category, $stock, $image)){
            return true;
        }
    }

    // Retrieves all food and drink items
    public function viewFoodAndDrinkController(){
        global $manager;

        $array = $manager -> viewFoodAndDrink();

        if(count($array) > 0){
            return $array;
        }
        else {
            return false;
        }
    }

    // Updates food and drink item information
    public function updateFoodAndDrinkController($updateID, $foodName, $description, $price, $category, $stock, $image, $status){
        global $manager;

        if($manager -> updateFoodAndDrink($updateID, $foodName, $description, $price, $category, $stock, $image, $status)){
            return true;
        }
    }

    // Retrieves food and drink item details
    public function getFoodAndDrinkDetail($updateID){
        global $manager;

        $array = $manager -> getFoodAndDrink($updateID);

        return $array;
    }

    // Deletes a food item
    public function deleteFoodController($deleteID){
        global $manager;

        if($manager -> deleteFood($deleteID)){
            return true;
        }
    }

    // Retrieves all reviews
    public function viewReviewController(){
        global $manager;
        $array = $manager -> viewReview();
        return $array;
    }

    // Retrieves available years
    public function getYearController(){
        global $manager;
        $array = $manager -> getYear();
        return $array;
    }

    // Generates monthly report
    public function generateMonthlyReportController($year, $month){
        global $manager;
        $array = $manager -> generateMonthlyReport($year, $month);
        return $array;
    }

    // Generates weekly report
    public function generateWeeklyReportController($startDate, $endDate){
        global $manager;
        $array = $manager -> generateWeeklyReport($startDate, $endDate);
        return $array;
    }

    // Retrieves room details based on search input and search by criteria
    public function getRoomDetailController($searchInput, $searchBy){
        global $manager;
        $array = $manager->getRoomDetail($searchInput, $searchBy);

        if(count($array) > 0){
            return $array;
        }
        else {
            return false;
        }
    }

    // Searches for movies based on search input
    public function searchMovieController($searchInput){
        global $manager;
        $array = $manager->searchMovie($searchInput);

        if(count($array) > 0){
            return $array;
        }
        else {
            return false;
        }
    }

    // Searches for food items based on search input
    public function searchFoodController($searchInput){
        global $manager;
        $array = $manager->searchFood($searchInput);

        if(count($array) > 0){
            return $array;
        }
        else {
            return false;
        }
    }
}

$controller = new manager_controller;

?>