<?php
session_start();
require('../model/customer_model.php');

$cust = $_SESSION['user'];

$customer = new customer;

$customer -> getProfile($cust);

print($customer -> getFname()); 
echo "<br>";
print($customer -> getLname()); 
echo "<br>";
print($customer -> getEmail()); 
echo "<br>";
print($customer -> getDob());
echo "<br>";
print($cust); 

?>