<?php
require ('../model/customer_model.php');
//require ('../view/header.php');
if (isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $con = new customer;
    $con -> createTable();
    if ($con -> createUser($fname,$lname,$phone,$email,$password,$dob)){
        echo '<script>alert("Sign up succesful")</script>'; 
        echo" <script>window.location='../view/index.php';</script>";
    }
}


?>
