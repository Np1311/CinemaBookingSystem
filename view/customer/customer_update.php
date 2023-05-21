<?php
session_start();
$profile = $_SESSION['profile'];
//require ('header_customer.html');
require('../header.html');
require ('../../controller/customer_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Update Profile</title>
  <script>

  function goBack() {
    window.history.go(-1);
  }
  
  </script>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial;
      font-size: 16px;
      background-color: #e7dbd0;
    }
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
    
    input[type="submit"],
    button {
      flex: 1;
            margin: 0 5px;
            padding-top:10px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            background-color: #bd9a7a;
            color: white;
            border: none;
            font-size: 14px;
            margin-left:40px;
            width:200px;
    }
    
    input[type="submit"]:hover {
      background-color:#e7dbd0;
            color: #bd9a7a;
            border: 1px solid white;
    }
    .custom-button {
            flex: 1;
            margin: 0 5px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            background-color: #bd9a7a;
            color: white;
            border: none;
            font-size: 14px;
            width:200px;
        }

        .custom-button:hover {
            background-color:#e7dbd0;
            color: #bd9a7a;
            border: 1px solid white;
        }
        .custom-button a {
            text-decoration: none;
            color: white;
        }
  </style>
</head>
<body>
    <?php
   if($controller -> getAccount_controller($_SESSION['profile'],$_SESSION['customerID']) == false){
    echo '<script>alert("No Movie listed")</script>';
    }else{
      $user = $controller -> getAccount_controller($_SESSION['profile'],$_SESSION['customerID']);
    }
   
    // $dob = DateTime::createFromFormat('d/m/Y', $user['dob']);
    // $formatted_dob = $dob->format('Y-m-d');
    ?>
  <div class="profile">
    <h1>Update Account</h1>
    <form  method="post">
      
      <label for="first_name">First Name:</label>
      <input type="text" name="first_name" id="first_name" value="<?php echo $user['fname']; ?>" required><br><br>
      <label for="last_name">Last Name:</label>
      <input type="text" name="last_name" id="last_name" value="<?php echo $user['lname']; ?>" required><br><br>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required><br><br>
      <label for="date_of_birth">Date of Birth:</label>
      <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo $user['dob']; ?>" required><br><br>
      <label for="phone">Phone Number:</label>
      <input type="text" name="phone" id="phone" value="<?php echo $user['phone']; ?>" required><br><br>
      <label for="pass">Password:</label>
      <input type="text" name="pass" id="pass" value="<?php echo $user['password']; ?>" required><br><br>
      <input type="submit" name="submit" value="Save Changes">
      <button type="button" class= "custom-button" onclick="goBack()">Back</button> <!--Check-->
    </form>
  </div>
  <?php
  if(isset($_POST['submit'])){
    
      $fname = $_POST['first_name'];
      $lname = $_POST['last_name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $dob = $_POST['date_of_birth'];
      $status = 'active';
      $password = $_POST['pass'];
      $oldPhone = $_SESSION['customerID'];
      
      if($controller -> updateUserController($profile,$fname,$lname,$phone,$email,$password,$dob,$status,$oldPhone)){
          echo" <script>window.location='customer_home_view.php';</script>";
          //echo "try";
      }
  }
  require('../footer.html');
  ?>
</body>

</html>