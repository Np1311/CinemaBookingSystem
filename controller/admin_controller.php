<?php
require('../model/admin_model.php');

$showProfile = new admin;

// $system_admin = $showProfile->getAllProfile('system_admin');
// $manager = $showProfile->getAllProfile('manager');
// $staff = $showProfile->getAllProfile('staff');
// $customer = $showProfile->getAllProfile('customer');

class admin_controller{
    public function displayUser($profile){
        global $showProfile;
        $arr = $showProfile->getAllProfile($profile);
        echo "<table>";
        echo "<tr><th>First name</th><th>Last name</th><th>Phone</th><th>Email</th><th>Password</th><th>Date of Birth</th></tr>";

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
                echo "</tr>";
            }
        }
        // close the table
        echo "</table>";
    }
}
?>