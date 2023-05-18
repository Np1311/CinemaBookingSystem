<?php
session_start();
require('../../controller/customer_controller.php');

$phone =  $_SESSION['customerID'];

//echo $customer -> getAccount();


if($controller -> getAccount_controller($_SESSION['profile'],$phone) == false){
  echo '<script>alert("No customer listed")</script>';
}else{
  $array = $controller -> getAccount_controller($_SESSION['profile'],$phone);
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
  <style>
    /* General styles */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial;
      font-size: 16px;
    }
  
    /* Profile styles */
    .profile {
      max-width: 600px;
      margin: auto;
      margin-top : 100px !important;
      margin-bottom : 350px !important;
      padding: 20px;
      background-color: #f2f2f2;
      border: 1px solid #ccc;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }
    
    table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
      vertical-align: top;
    }
    
    th {
      background-color: #eee;
      font-weight: bold;
    }
    
    /* Button styles */
    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      text-align: center;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
    }
    
    .button:hover {
      background-color: #3e8e41;
    }
  </style>
</head>
<body>
<?php
  // Assume we have fetched the user's profile data from a database


  //require ('header_login.html');
  ?>
  
  <div class="profile">
    <table>
      <tr>
        <th>First Name</th>
        <td><?php echo $array['fname']; ?></td>
      </tr>
      <tr>
        <th>Last Name</th>
        <td><?php echo $array['lname']; ?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td><?php echo $array['email']; ?></td>
      </tr>
      <tr>
        <th>Date of Birth</th>
        <td><?php echo $array['dob']; ?></td>
      </tr>
      <tr>
        <th>Phone Number</th>
        <td><?php echo $phone; ?></td>
      </tr>
    </table>
    <button class="button" onclick="location.href='customer_update.php'">Edit Profile</button>
  </div>
  
  <?php require ('../footer.html');?>
</body>


</html>