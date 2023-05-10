<?php
require('../model/user_model.php');
// $curProfile = $_GET['curProfile'];
// $userID = $_GET['updateID'];
// print_r($curProfile);
// print_r($userID);
//$admin = new admin_model;
$user = new user_model;
// $arr = $admin->getProfile($curProfile,$userID);
// print_r($arr);

class user_update_controller{
    public function showUpdate($curProfile,$userID){
        global $user;
        $arr = $user->getAccount($curProfile,$userID);
        $formatted_dob=date('Y-m-d', strtotime($arr['dob']));
        // $dob = DateTime::createFromFormat('Y-m-d', $arr['dob']);
        // $formatted_dob = $dob->format('d/m/Y');
        $arr['dob'] = $formatted_dob;

        return $arr;
        
    }
    public function validateUser($curProfile,$fname,$lname,$phone,$email,$dob,$status,$oldPhone){
        global $user;
        if($user -> updateUser($curProfile,$fname,$lname,$phone,$email,$dob,$status,$oldPhone)){
            
            return true;
        }
    }
}
?>