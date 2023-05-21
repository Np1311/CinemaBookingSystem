<?php
require('../../controller/manager_controller.php');



if(isset($_GET['deleteID'])){
    // Check if the 'deleteID' parameter is set in the URL query parameters
    $deleteID = $_GET['deleteID'];
    // Call the deleteMovieController method of the $controller object, passing $deleteID as a parameter
    if($controller -> deleteMovieController($deleteID)){
        
        echo" <script>window.location='../manager/manager_view_movie.php';</script>";
    }
}

?>