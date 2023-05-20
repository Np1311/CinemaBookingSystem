<?php
require('../model/user_model.php');

$user = new user_model;

class user_update_controller{
    
    // Retrieves user account details for update
    public function showUpdate($curProfile, $userID){
        global $user;
        
        $arr = $user->getAccount($curProfile, $userID);
        $formatted_dob = date('Y-m-d', strtotime($arr['dob']));
        // $dob = DateTime::createFromFormat('Y-m-d', $arr['dob']);
        // $formatted_dob = $dob->format('d/m/Y');
        $arr['dob'] = $formatted_dob;

        return $arr;
    }
    
    // Validates and updates user account information
    public function validateUser($curProfile, $fname, $lname, $phone, $email, $password, $dob, $status, $oldPhone){
        global $user;
        
        if($user->updateUser($curProfile, $fname, $lname, $phone, $email, $password, $dob, $status, $oldPhone)){
            return true;
        }
    }
}

?>