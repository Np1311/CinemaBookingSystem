<?php
require('../../controller/manager_controller.php');



if(isset($_GET['deleteID'])){
    // Get the value of 'deleteID' from the URL query parameters
    $deleteID = $_GET['deleteID'];
    // Call the deleteRoomController method of the $controller object, passing $deleteID as a parameter
    if($controller -> deleteRoomController($deleteID)){
        
        echo" <script>window.location='../manager/manager_view_cinemaRoom.php';</script>";
    }
}

?>