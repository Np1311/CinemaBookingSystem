<?php
require_once('../model/login_model.php');

class login_controller{

    // Validates user login credentials
    public function validateLogin($profile, $loginPhone, $loginPass){
        
        $login = new login_model($profile, $loginPhone, $loginPass);

        if($login -> checkUser()){
            return true;
        }else{
            return false;
        }
    }
    
    // Logs out the user
    public function logoutController(){
        
        $login = new login_model(null, null, null);

        if($login -> logout()){
            return true;
        }
    }
}

$controller = new login_controller();
?>