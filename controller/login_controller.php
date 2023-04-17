<?php
session_start();
require('../model/customer_model.php');
if (isset($_POST['submit'])){
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    
    $con = new customer;
    if($con -> checkUser($phone ,$pass)){
        echo" <script>window.location='../view/customer_home_view.php';</script>";
    }
    $con -> setAccount($phone);
    $_SESSION['user'] = $con -> getAccount();
        
    
}

?>