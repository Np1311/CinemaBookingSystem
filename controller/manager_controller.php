<?php
require('../../model/manager_model.php');

$manager = new manager;

class manager_controller{

    public function createRoomController($roomName, $roomType){
        global $manager;

        if($manager -> createRoom($roomName, $roomType)){
            return true;
        }
    }
}
?>