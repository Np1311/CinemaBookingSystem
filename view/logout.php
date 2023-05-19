<?php
require('../controller/login_controller.php');

if($controller ->logoutController()){
    echo "<script>window.location='index.php';</script>";
}

?>