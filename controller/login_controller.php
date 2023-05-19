<?php

require('../model/login_model.php');





class login_controller{

    public function validateLogin($profile,$loginPhone, $loginPass){
        global $user;
        echo $profile;
        $login = new login_model($profile,$loginPhone, $loginPass);

        if($login -> checkUser()){
            //$userArr = $user -> getAccount();
            $user -> setAccount($loginPhone);
        
            return true;
        }else{
            return false;
        }
        
    }
}
?>