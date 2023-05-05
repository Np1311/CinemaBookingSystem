<?php
require('../controller/user_update_controller.php');
$curProfile = $_GET['curProfile'];
$userID = $_GET['updateID'];
$userAccount = new user_update_controller;
$arr = $userAccount -> showUpdate($curProfile,$userID);
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
    echo "<input type='date' name='date_of_birth' id='date_of_birth' value=".$arr['dob']."><br><br>";
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
if(isset($_POST['submit'])){
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['date_of_birth'];
    $status = $_POST['status'];
    if($userAccount ->validateUser($curProfile,$fname,$lname,$phone,$email,$dob,$status,$userID)){
        
        echo" <script>window.location='../view/admin_home_view.php';</script>";
    }

}

// print_r($curProfile);
// print_r($userID);

// $arr = $admin->getProfile($curProfile,$userID);
// print_r($arr);

?>
<html>
    <head>
    <style>
        .profile {
            margin: 0 auto;
            max-width: 500px;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.3);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="email"], input[type="date"], select {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        select {
            height: 40px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #0062cc;
        }
    </style>
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
