<?php
require('../model/admin_model.php');

$showProfile = new admin;

// $system_admin = $showProfile->getAllProfile('system_admin');
// $manager = $showProfile->getAllProfile('manager');
// $staff = $showProfile->getAllProfile('staff');
// $customer = $showProfile->getAllProfile('customer');

class admin_controller{
    public function displayUser(){
        global $showProfile;
        
        $profileArr = $showProfile->listedProfile();
        foreach ($profileArr as $element) {
            $arr = $showProfile->getAllProfile($element);
            echo "<h2>$element</h2>";
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
                        <button class="btn btn-primary"><a href="../view/userUpdate.php?updateID='.$array['phone'].'&curProfile='.$element.'"
                        class="text-light">Update</a></button>
                        <button class="btn-danger"><a href="../controller/admin_controller.php?deleteID='.$array['phone'].'&curProfile='.$element.'" class="text-light">Delete</a></
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
        global $showProfile;
        $profileArr = $showProfile -> listedProfile();
        if (in_array($newProfile, $profileArr))
        {
            return false;
        }
        else
        {
            if($showProfile->createTable($newProfile)){
                return true;
            }else{
                return false;
            }
        }
    }

}
// $admin = new admin_controller;
// $admin -> validateProfile('customer');
if(isset($_GET['deleteID'])){
    $userID = $_GET['deleteID'];
    $curProfile = $_GET['curProfile'];
    if($showProfile->suspendAccount($curProfile,$userID)){
        echo" <script>window.location='../view/admin_home_view.php';</script>";
        return true;
    }

}
?>