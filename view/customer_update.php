<?php
session_start();
$cust = $_SESSION['user'];
require ('header_login.html');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Update Profile</title>
  <style>
    /* Styles for the profile form */
    .profile {
      max-width: 500px;
      margin: 0 auto;
      margin-top: 100px;
      margin-bottom: 100px;
      padding: 20px;
      background-color: #f5f5f5;
      border: 1px solid #ddd;
    }
    
    h1 {
      text-align: center;
      font-size: 32px;
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="date"] {
      width: 95%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 3px;
    }
    
    input[type="submit"] {
      display: block;
      margin: 0 auto;
      padding: 10px 20px;
      background-color: #428bca;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: #3071a9;
    }
  </style>
</head>
<body>
    <?php
    $user = $_SESSION['profileInfo'];
    $dob = DateTime::createFromFormat('d/m/Y', $user['date_of_birth']);
    $formatted_dob = $dob->format('Y-m-d');
    ?>
  <div class="profile">
    <h1>Update Profile</h1>
    <form  method="post">
      
      <label for="first_name">First Name:</label>
      <input type="text" name="first_name" id="first_name" value="<?php echo $user['first_name']; ?>"><br><br>
      <label for="last_name">Last Name:</label>
      <input type="text" name="last_name" id="last_name" value="<?php echo $user['last_name']; ?>"><br><br>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>"><br><br>
      <label for="date_of_birth">Date of Birth:</label>
      <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo $formatted_dob; ?>"><br><br>
      <label for="phone">Phone Number:</label>
      <input type="text" name="phone" id="phone" value="<?php echo $user['phone']; ?>"><br><br>
      <input type="submit" name="submit" value="Save Changes">
    </form>
  </div>
  <?php
  require('../controller/customer_update_controller.php');
  require('footer.html');
  ?>
</body>
</html>