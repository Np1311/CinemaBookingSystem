<?php

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
        $login = new login_model($profile,$loginPhone, $loginPass);

        if($login -> checkUser()){
            //$userArr = $user -> getAccount();
            $user -> setAccount($loginPhone);
            // $_SESSION['user'] = $user -> getPhone();
            if($profile == 'customer'){
                echo" <script>window.location='../view/customer/customer_home_view.php';</script>";}
            else if ($profile == 'system_admin'){
                echo" <script>window.location='../view/admin_home_view.php';</script>";
            }else if ($profile == 'staff'){
                echo" <script>window.location='../view/staff/staff_home_view.php';</script>";
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