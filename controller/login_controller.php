<?php

require('../model/login_model.php');





class login_controller{

    public function validateLogin($profile,$loginPhone, $loginPass){
        global $user;
        $login = new login_model($profile,$loginPhone, $loginPass);

        if($login -> checkUser()){
            return true;
        }else{
            return false;
        }
        
    }
}

?>