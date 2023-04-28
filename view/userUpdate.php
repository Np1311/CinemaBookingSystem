<?php
require('../model/admin_model.php');
$curProfile = $_GET['curProfile'];
$userID = $_GET['updateID'];
print_r($curProfile);
print_r($userID);
$admin = new admin;
$arr = $admin->getProfile($curProfile,$userID);
print_r($arr);

?>
<html>
    <head>
    </head>
    <body>
        <!-- 
        <?php
        // $user = $_SESSION['profileInfo'];
        // $dob = DateTime::createFromFormat('d/m/Y', $arr['dob']);
        // $formatted_dob = $dob->format('Y-m-d');
        ?>
        <div class="profile">
            <h1>Update Profile</h1>
            <form  method="post">
            
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="<?php //echo $user['first_name']; ?>"><br><br>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="<?php //echo $user['last_name']; ?>"><br><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php //echo $user['email']; ?>"><br><br>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" id="date_of_birth" value="<?php //echo $dob; ?>"><br><br>
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" value="<?php //echo $user['phone']; ?>"><br><br>
            <input type="submit" name="submit" value="Save Changes">
            </form>
        </div> -->
    </body>
</html>
