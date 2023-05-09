<?php
require ('../model/user_model.php');

$model = new user;
//require ('../view/header.php');
class SignUpController{
    
    public function createAccount($profile,$fname,$lname,$phone,$email,$password,$dob){
        global $model;
        if($model->createUser($profile,$fname,$lname,$phone,$email,$password,$dob)){
            return true;
        }

    }
}
?>
