<?php
session_start();

if(isset($_POST['new_total_price']) && isset($_POST['new_loyalty_point'])) {
    // Update the session variables with the new values
    $_SESSION['new_total_price'] = $_POST['new_total_price'];
    $_SESSION['new_loyalty_point'] = $_POST['new_loyalty_point'];
}
?>