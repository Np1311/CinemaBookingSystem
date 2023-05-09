<?php
require ('../model/user_model.php');

$model = new user;
//require ('../view/header.php');
class SignUpController{
    public function createAccount($profile,$fname,$lname,$phone,$email,$password,$dob){
        global $system_admin_session;
        if($model->createUser($profile,$fname,$lname,$phone,$email,$password,$dob)){
            return true;
        }

    }
}
?>
