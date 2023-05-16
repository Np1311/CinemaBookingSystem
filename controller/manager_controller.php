<?php
require('../../model/manager_model.php');


$manager = new manager_model;

class manager_controller{

    public function createRoomController($roomName, $roomType, $roomCapacity, $totalRow, $totalColumn){
        global $manager;

        if($manager -> createRoom($roomName, $roomType, $roomCapacity, $totalRow, $totalColumn)){
            return true;
        }
    }

    public function viewRoomController(){
        global $manager;

        $arr = $manager -> viewRoom();
        print_r($arr);
        return $arr;
    }

    public function deleteRoomController($deleteID){
        global $manager;

        if($manager -> deleteRoom($deleteID)){
            return true;
        }
    }

    public function getRoomDetail($updateID){
        global $manager;

        $array = $manager -> getRoom($updateID);

        return $array;
    }

    public function updateRoomController($updateID,$movieName,$movieBanner, $relDate, $genre, $duration, $status){
        global $manager;

        if($manager -> updateRoom($updateID,$movieName,$movieBanner, $relDate, $genre, $duration, $status)){
            return true;
        }
    }

    public function createMovieController($movieName,$movieBanner, $relDate, $genre, $duration){
        global $manager;

        if($manager -> createMovie($movieName,$movieBanner, $relDate, $genre, $duration)){
            return true;
        }
    }

    public function viewMovieController(){
        global $manager;

        $array = $manager -> getMovie();

        return $array;
    }
    public function updateMovieController($updateID,$movieName,$movieBanner, $relDate, $genre, $duration, $status, $roomID, $timing1,$timing2,$timing3,$timing4){
        global $manager;
        

        if($manager -> updateMovie($updateID,$movieName,$movieBanner, $relDate, $genre, $duration, $status, $roomID, $timing1,$timing2,$timing3,$timing4)){
            return true;
        }
    }
    public function getMovieDetail($updateID){
        global $manager;

        $array = $manager -> movieDetail($updateID);

        return $array;
    }
    public function deleteMovieController($deleteID){
        global $manager;

        if($manager -> deleteMovie($deleteID)){
            return true;
        }
    }
    public function allocateMovieController($movieID,$roomID,$timing1,$timing2,$timing3,$timing4){
        global $manager;

        if($manager -> allocateMovie($movieID,$roomID,$timing1,$timing2,$timing3,$timing4)){
            return true;
        }
    }
    public function createFoodController($foodName,$description, $price, $category, $stock, $image){
        global $manager;

        if($manager -> createFood($foodName,$description, $price, $category, $stock, $image)){
            return true;
        }
    }
    public function viewFoodAndDrinkController(){
        global $manager;

        $array = $manager -> viewFoodAndDrink();

        return $array;
    }

    public function updateFoodAndDrinkController($updateID,$foodName,$description, $price, $category, $stock, $image, $status){
        global $manager;
        

        if($manager -> updateFoodAndDrink($updateID,$foodName,$description, $price, $category, $stock, $image, $status)){
            return true;
        }
    }
    public function getFoodAndDrinkDetail($updateID){
        global $manager;

        $array = $manager -> getFoodAndDrink($updateID);

        return $array;
    }
    public function deleteFoodController($deleteID){
        global $manager;

        if($manager -> deleteFood($deleteID)){
            return true;
        }
    }
    public function viewReviewController(){
        global $manager;
        $array = $manager -> viewReview();
        return $array;
    }
    public function getYearController(){
        global $manager;
        $array = $manager -> getYear();
        return $array;
    }
}

$controller = new manager_controller;
?>