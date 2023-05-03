<?php
session_start();
require('../model/login_model.php');




class login_controller{
    // private $profile;
    // private $uid;
    // private $pass;

    // public function _construct($profile,$phone, $pass){
    //     $this->profile = $profile;
    //     $this->uid = $phone;
    //     $this->pass = $pass;
    // }

    public function validateLogin($profile,$loginPhone, $loginPass){
        global $user;
        echo $profile;
        $login = new login($profile,$loginPhone, $loginPass);

        if($login -> checkUser()){
            //$userArr = $user -> getAccount();
            $user -> setAccount($loginPhone);
            $_SESSION['user'] = $user -> getAccount();
            if($profile == 'customer'){
            echo" <script>window.location='../view/customer_home_view.php';</script>";}
            else if ($profile == 'system_admin'){
                echo" <script>window.location='../view/admin_home_view.php';</script>";
            }else if ($profile == 'staff'){
                echo" <script>window.location='../view/staff_home_view.php';</script>";
            }else if ($profile == 'manager'){
                echo" <script>window.location='../view/manager/manager_home_view.php';</script>";
            }

            
            // $userArr = $user -> getAccount();
            return true;
        }else{
            return false;
        }
        
    }
}
?>