<?php
require('../model/admin_model.php');

$system_admin_session = new admin;

// $system_admin = $showProfile->getAllProfile('system_admin');
// $manager = $showProfile->getAllProfile('manager');
// $staff = $showProfile->getAllProfile('staff');
// $customer = $showProfile->getAllProfile('customer');

class admin_controller{
    public function displayUser(){
        global $system_admin_session;
        
        $profileArr = $system_admin_session->listedProfile();
        $profileArr = array_filter($profileArr, function($profile) {
            return stripos($profile, 'cinema') === false;
        });
        
        foreach ($profileArr as $profile) {
            $arr = $system_admin_session->getAllProfile($profile);
            echo "<h2>$profile</h2>";
            echo "<table>";
            echo "<tr><th>First name</th><th>Last name</th><th>Phone</th><th>Email</th><th>Password</th><th>Date of Birth</th><th>Status</th><th>Action</th></tr>";

            // loop through results and display in table rows
            if(count($arr) > 0 )
            {
                foreach($arr as $key => $array){
                    echo "<tr>";
                    echo "<td>" . $array['fname'] . "</td>";
                    echo "<td>" . $array['lname'] . "</td>";
                    echo "<td>" . $array['phone'] . "</td>";
                    echo "<td>" . $array['email'] . "</td>";
                    echo "<td>" . $array['password'] . "</td>";
                    echo "<td>" . $array['dob'] . "</td>";
                    echo "<td>" . $array['status'] . "</td>";
                    echo '<td >
                        <button class="btn btn-primary"><a href="../view/userUpdate.php?updateID='.$array['phone'].'&curProfile='.$profile.'"
                        class="text-light">Update</a></button>
                        <button class="btn-danger"><a href="../view/admin_home_view.php?deleteID='.$array['phone'].'&curProfile='.$profile.'" class="text-light">Delete</a></
                        button> 
                        </td>' ; 
                    echo "</tr>";
                }
            }
            // close the table
            echo "</table>";
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

    public function createAccount($profile,$fname,$lname,$phone,$email,$password,$dob){
        global $system_admin_session;
        if($system_admin_session->createUser($profile,$fname,$lname,$phone,$email,$password,$dob)){
            return true;
        }

    }
    public function deleteAccount(){
        global $system_admin_session;
        $userID = $_GET['deleteID'];
        $curProfile = $_GET['curProfile'];
        if($system_admin_session->suspendAccount($curProfile,$userID)){
            // echo" <script>window.location='../view/admin_home_view.php';</script>";
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
    public function susProfile($deleteProfile){
        global $system_admin_session;
        if($system_admin_session->deleteProfile($deleteProfile)){
            
            return true;
        }
    }
    public function reactivateProfile($reactivateProfile){
        global $system_admin_session;
        if($system_admin_session->activateProfile($reactivateProfile)){
            
            return true;
        }
    }

}
// $admin = new admin_controller;
// // $admin -> validateProfile('customer');
// if(isset($_GET['deleteID'])){
//    $admin->deleteAccount(); 

// }

// if(isset($_POST['deleteProfile'])){
//     $deleteProfile = $_POST['deleteProfile'];
//     if($system_admin_session->deleteProfile($deleteProfile)){
//         echo" <script>window.location='../view/admin_home_view.php';</script>";
//         return true;
//     }
// }
?>