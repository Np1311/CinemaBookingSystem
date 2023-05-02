<?php
require('../controller/login_controller.php');
if (isset($_POST['submit'])){
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    if(isset($_SESSION['profile'])== null){
        $_SESSION['profile'] = 'customer';
    }
    echo $_SESSION['profile'];
    
    $controller = new login_controller();
    
    $controller->validateLogin($_SESSION['profile'],$phone,$pass);
        
    
}
?>