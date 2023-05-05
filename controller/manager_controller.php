<?php
require('../../model/manager_model.php');

$manager = new manager;

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

    public function updateRoomController($updateID,$roomName,$roomType,$roomCapacity,$totalRow,$totalColumn,$status){
        global $manager;

        if($manager -> updateRoom($updateID,$roomName,$roomType,$roomCapacity,$totalRow,$totalColumn,$status)){
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
    public function updateMovieController($updateID,$movieName,$movieBanner, $relDate, $genre, $duration,$status){
        global $manager;
        

        if($manager -> updateMovie($updateID,$movieName,$movieBanner, $relDate, $genre, $duration,$status)){
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
}

$controller = new manager_controller;
?>