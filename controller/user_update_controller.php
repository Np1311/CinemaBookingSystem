<?php
require('../model/user_model.php');

$user = new user_model;

class user_update_controller{
    
    // Retrieves user account details for update
    public function showUpdate($curProfile, $userID){
        global $user;
        
        // Get the account details for the given profile and user ID
        $arr = $user->getAccount($curProfile, $userID);
        // Format the date of birth to 'Y-m-d' format
        $formatted_dob = date('Y-m-d', strtotime($arr['dob']));

        // $dob = DateTime::createFromFormat('Y-m-d', $arr['dob']);
        // $formatted_dob = $dob->format('d/m/Y');

        // Update the dob value with the formatted date
        $arr['dob'] = $formatted_dob;

        return $arr;
    }
    
    // Validates and updates user account information
    public function validateUser($curProfile, $fname, $lname, $phone, $email, $password, $dob, $status, $oldPhone){
        global $user;
        
        // Update the user account information using the user model
        if($user->updateUser($curProfile, $fname, $lname, $phone, $email, $password, $dob, $status, $oldPhone)){
            return true;
        }
    }
}

?>