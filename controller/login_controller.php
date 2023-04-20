<?php
session_start();
require('../model/login_model.php');
$con = new login;



class login_controller{
    private $profile;
    private $uid;
    private $pass;

    public function __construct($profile,$phone, $pass){
        $this->profile = $profile;
        $this->uid = $phone;
        $this->pass = $pass;
    }

    public function login(){
        global $con;
        global $user;

        if($con -> checkUser($this->profile,$this->uid ,$this->pass)){
            //$userArr = $user -> getAccount();
            $user -> setAccount($this->uid);
            $_SESSION['user'] = $user -> getAccount();
            if($this->profile == 'customer'){
            echo" <script>window.location='../view/customer_home_view.php';</script>";}
            else if ($this->profile == 'system_admin'){
                echo" <script>window.location='../view/admin_home_view.php';</script>";
            }

            
            // $userArr = $user -> getAccount();
            return true;
        }else{
            return false;
        }
        
    }
}
?>