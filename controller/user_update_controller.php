<?php
require('../model/admin_model.php');
// $curProfile = $_GET['curProfile'];
// $userID = $_GET['updateID'];
// print_r($curProfile);
// print_r($userID);
$admin = new admin;
// $arr = $admin->getProfile($curProfile,$userID);
// print_r($arr);

class user_update_controller{
    public function showUpdate($curProfile,$userID){
        global $admin;
        $arr = $admin->getProfile($curProfile,$userID);
        $formatted_dob=date('Y-m-d', strtotime($arr['dob']));
        // $dob = DateTime::createFromFormat('Y-m-d', $arr['dob']);
        // $formatted_dob = $dob->format('d/m/Y');
        echo "<div class='profile'>";
            echo "<h1>Update Profile</h1>";
            echo "<form  method='post'>";
                echo "<label for='first_name'>First Name:</label>";
                echo "<input type='text' name='first_name' id='first_name' value=".$arr['fname']."><br><br>";
                echo '<label for="last_name">Last Name:</label>';
                echo "<input type='text' name='last_name' id='last_name' value=".$arr['lname']."><br><br>";
                echo '<label for="email">Email:</label>';
                echo "<input type='email' name='email' id='email' value=".$arr['email']."><br><br>";
                echo '<label for="date_of_birth">Date of Birth:</label>';
                echo "<input type='date' name='date_of_birth' id='date_of_birth' value=".$formatted_dob."><br><br>";
                echo '<label for="phone">Phone Number:</label>';
                echo "<input type='text' name='phone' id='phone' value=".$arr['phone']."><br><br>";
                echo '<label for="status">Status:</label>';
                echo '<select class="form-control" name="status">';
                    if($arr['status'] == 'active') {
                        echo '<option value="active" SELECTED> active </option>';
                        echo '<option value="suspend" > suspend </option>';
                    } else{
                        echo '<option value="active"> active </option>';
                        echo '<option value="suspend" SELECTED> suspend </option>';
                    }
                        
                echo'</select><br><br>';
                echo '<input type="submit" name="submit" value="Save Changes">';
            echo "</form>";
        echo "</div>";
    }
    public function validateUser($curProfile,$fname,$lname,$phone,$email,$dob,$status,$oldPhone){
        global $admin;
        if($admin -> updateUser($curProfile,$fname,$lname,$phone,$email,$dob,$status,$oldPhone)){
            
            return true;
        }
    }
}
?>