<?php
session_start();
require('../model/customer_model.php');

$cust = $_SESSION['user'];

print($cust);
?>