<?php
require('../model/admin_model.php');


$system_admin_session = new admin_model;
class admin_controller{
    public function displayUser() {
        global $system_admin_session;
    
        $profileArr = $system_admin_session->listedProfile();
        $excluded = array(
            "booking",
            "customerReview",
            "fnbOrder",
            "orderItem",
            'cinemaAllocation',
            'cinemaFoodAndDrink',
            'cinemaMovie',
            'cinemaRoom',
            'cinemaallocation',
            'cinemafoodanddrink',
            'cinemamovie',
            'cinemaroom'
          );
          
          $profileArr = array_filter($profileArr, function ($value) use ($excluded) {
            return !in_array($value, $excluded);
          });
       
    
        foreach ($profileArr as $profile) {
            $arr = $system_admin_session->getAllAccount($profile);
            
            echo "<div class='profileTable'>";
            echo "<h2 style='text-align: 0 auto;'>" . ucfirst($profile) . "</h2>";
            echo "<table>";
            echo "<tr><th>First name</th><th>Last name</th><th>Phone</th><th>Email</th><th>Password</th><th>Date of Birth</th><th>Status</th><th>Action</th></tr>";
    
            // loop through results and display in table rows
            if (count($arr) > 0) {
                foreach ($arr as $key => $array) {
                    echo "<tr>";
                    echo "<td>" . $array['fname'] . "</td>";
                    echo "<td>" . $array['lname'] . "</td>";
                    echo "<td>" . $array['phone'] . "</td>";
                    echo "<td>" . $array['email'] . "</td>";
                    echo "<td>" . $array['password'] . "</td>";
                    echo "<td>" . $array['dob'] . "</td>";
                    echo "<td>" . $array['status'] . "</td>";
                    echo '<td class="action-cell">
                            <button class="btn btn-primary"><a href="../view/userUpdate.php?updateID='.$array['phone'].'&curProfile='.$profile.'"
                            class="text-light">Update</a></button>
                            <button class="btn btn-danger"><a href="../view/admin_home_view.php?deleteID='.$array['phone'].'&curProfile='.$profile.'" class="text-light">Suspend</a></
                            button> 
                          </td>';
                    echo "</tr>";
                }
            }
            // close the table
            echo "</table>";
            echo "</div>";
        }
    }
    
    public function validateProfile($newProfile){
        global $system_admin_session;
        $profileArr = $system_admin_session -> listedProfile();
        if (in_array($newProfile, $profileArr))
        {
            return false;
        }
        else
        {
            if($system_admin_session->createTable($newProfile)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function suspendAccountController($curProfile,$userID){
        global $system_admin_session;
        
        if($system_admin_session->suspendAccount($curProfile,$userID)){
            
            return true;
        }
    }
    public function showProfile(){
        global $system_admin_session;
        
        $profileArr = $system_admin_session->listedProfile();
        $profileArr = array_filter($profileArr, function($profile) {
            return stripos($profile, 'cinema') === false;
        });
        foreach ($profileArr as $element) {
            echo "<option value='" . $element . "'>" . $element . "</option>";
        }
    }
    public function susProfile($suspendProfile){
        global $system_admin_session;
        if($system_admin_session->suspendProfile($suspendProfile)){
            
            return true;
        }
    }
    public function reactivateProfile($reactivateProfile){
        global $system_admin_session;
        if($system_admin_session->activateProfile($reactivateProfile)){
            
            return true;
        }
    }

    public function searchProfile($searchProfile){
        global $system_admin_session;

        $arrayProfile = $system_admin_session -> listedProfile();

        if (in_array($searchProfile, $arrayProfile)){
            $array = $system_admin_session->getAllAccount($searchProfile);
            return $array;
        }else{
            return false;
        }
    }
    public function searchAccount($profile,$searchAccount,$searchBy){
        global $system_admin_session;

        $array = $system_admin_session->getAccountDetail($profile,$searchAccount,$searchBy);

        if(count($array)>0){
            return $array;
        }
        else {
            return false;
        }
    }
    
    public function updateProfileController($updateProfile,$updateValue){
        global $system_admin_session;

        if($system_admin_session->updateProfile($updateProfile,$updateValue)){
            
            return true;
        }
    }

}

?>