<?php
session_start();
require('../model/login_model.php');

if (isset($_POST['submit'])){
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    
    $con = new login;
    
    if($con -> checkUser($phone ,$pass)){
        echo" <script>window.location='../view/customer_home_view.php';</script>";
    }
    $user -> setAccount($phone);
    $_SESSION['user'] = $user -> getAccount();
        
    
}

?>