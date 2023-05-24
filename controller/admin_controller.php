<?php
require('../model/admin_model.php');

$system_admin_session = new admin_model;

class admin_controller {
    public function displayUser() {
        global $system_admin_session;
        
        // Get the list of profiles from the admin model
        $profileArr = $system_admin_session->listedProfile();
        
        // Exclude certain profiles from the display
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
            'cinemaroom',
            "customerreview",
            "fnborder",
            "orderitem"
        );
        
        // Filter out the excluded profiles
        $profileArr = array_filter($profileArr, function ($value) use ($excluded) {
            return !in_array($value, $excluded);
        });
        
        // Loop through each profile and display the user information in a table
        foreach ($profileArr as $profile) {
            $arr = $system_admin_session->getAllAccount($profile);
            
            echo "<div class='profileTable'>";
            echo "<h2 style='text-align: 0 auto;'>" . ucfirst($profile) . "</h2>";
            echo "<table>";
            echo "<tr><th>First name</th><th>Last name</th><th>Phone</th><th>Email</th><th>Password</th><th>Date of Birth</th><th>Status</th><th>Action</th></tr>";
    
            // Loop through the user accounts and display the details in table rows
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
                            <button class="btn btn-danger"><a href="../view/admin_home_view.php?deleteID='.$array['phone'].'&curProfile='.$profile.'" class="text-light">Suspend</a></button> 
                          </td>';
                    echo "</tr>";
                }
            }
            // Close the table
            echo "</table>";
            echo "</div>";
        }
    }
    
    //function to validate profile
    public function validateProfile($newProfile) {
        global $system_admin_session;
        $profileArr = $system_admin_session->listedProfile();
        
        // Check if the new profile already exists
        if (in_array($newProfile, $profileArr)) {
            return false;
        } else {
            // If the new profile doesn't exist, create a new table for it
            if ($system_admin_session->createTable($newProfile)) {
                return true;
            } else {
                return false;
            }
        }
    }
    //function to suspend account
    public function suspendAccountController($curProfile, $userID) {
        global $system_admin_session;
        
        // Suspend the account for the given profile and user ID
        if ($system_admin_session->suspendAccount($curProfile, $userID)) {
            return true;
        }
    }
    
    //function to show profile
    public function showProfile() {
        global $system_admin_session;
        
        // Get the list of profiles from the admin model, excluding profiles starting with 'cinema'
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
            'cinemaroom',
            "customerreview",
            "fnborder",
            "orderitem"
        );
        
        // Filter out the excluded profiles
        $profileArr = array_filter($profileArr, function ($value) use ($excluded) {
            return !in_array($value, $excluded);
        });
        
        // $profileArr = array_filter($profileArr, function($profile) {
        //     return stripos($profile, 'cinema') === false;
        // });
        
        // Display the profile options in a select dropdown
        foreach ($profileArr as $element) {
            echo "<option value='" . $element . "'>" . $element . "</option>";
        }
    }
    
    //function to suspend profile
    public function susProfile($suspendProfile) {
        global $system_admin_session;
        
        // Suspend the given profile
        if ($system_admin_session->suspendProfile($suspendProfile)) {
            return true;
        }
    }
    
    //function to reactivate profile
    public function reactivateProfile($reactivateProfile) {
        global $system_admin_session;
        
        // Reactivate the given profile
        if ($system_admin_session->activateProfile($reactivateProfile)) {
            return true;
        }
    }

    //function to search profile
    public function searchProfile($profile) {
        global $system_admin_session;
        
        // Get the list of profiles from the admin model
        $arrayProfile = $system_admin_session->listedProfile();
        
        // Check if the search profile exists
        if (in_array($profile, $arrayProfile)) {
            // Get the user accounts for the search profile
            $array = $system_admin_session->getAllAccount($profile);
            return $array;
        } else {
            return false;
        }
    }
    
    //function to search account
    public function searchAccount($profile, $searchAccount, $searchBy) {
        global $system_admin_session;
        
        // Get the account details for the search parameters
        $array = $system_admin_session->getAccountDetail($profile, $searchAccount, $searchBy);
        
        if (count($array) > 0) {
            return $array;
        } else {
            return false;
        }
    }
    
    //function to update profile
    public function updateProfileController($updateProfile, $updateValue) {
        global $system_admin_session;
        
        // Update the profile with the new value
        if ($system_admin_session->updateProfile($updateProfile, $updateValue)) {
            return true;
        }
    }
}
?>
