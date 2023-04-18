<?php

require('../model/customer_model.php');
if(isset($_POST['submit'])){
    
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['date_of_birth'];
    $oldPhone = $_SESSION['user'];
    $customer = new customer;
    if($customer -> updateUser($fname,$lname,$phone,$email,$dob,$oldPhone)){
        echo" <script>window.location='../view/customer_profile_view.php';</script>";
    }
}


?>