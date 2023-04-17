<?php
session_start();

if (isset($_POST['submit'])){
    $_SESSION['phone'] = $_POST['phone'];
    $pass = $_POST['pass'];
    
    $con = new customer;
    if($con -> checkUser($_SESSION['phone'] ,$pass)){
        echo" <script>window.location='../view/customer_home_view.php';</script>";
    }
    $con -> setAccount($_SESSION['phone']);
        
    
}

?>