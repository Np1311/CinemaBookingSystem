<?php
require('../../controller/manager_controller.php');



if(isset($_GET['deleteID'])){
    $deleteID = $_GET['deleteID'];

    if($controller -> deleteFoodController($deleteID)){
        
        echo" <script>window.location='../manager/manager_view_food.php';</script>";
    }
}

?>