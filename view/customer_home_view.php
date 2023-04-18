<?php
session_start();
require('../model/customer_model.php');

$cust = $_SESSION['user'];

$customer = new customer;

$customer -> getProfile($cust);


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
      font-family: Arial, sans-serif;
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
  $user = array(
    'first_name' => $customer -> getFname(),
    'last_name' => $customer -> getLname(),
    'email' => $customer -> getEmail(),
    'date_of_birth' => $customer -> getDob(),
    'phone' => $cust
  );

  require ('header_login.html');
  ?>
  
  <div class="profile">
    <table>
      <tr>
        <th>First Name</th>
        <td><?php echo $user['first_name']; ?></td>
      </tr>
      <tr>
        <th>Last Name</th>
        <td><?php echo $user['last_name']; ?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td><?php echo $user['email']; ?></td>
      </tr>
      <tr>
        <th>Date of Birth</th>
        <td><?php echo $user['date_of_birth']; ?></td>
      </tr>
      <tr>
        <th>Phone Number</th>
        <td><?php echo $user['phone']; ?></td>
      </tr>
    </table>
    <button class="button" onclick="location.href='edit_profile.php'">Edit Profile</button>
  </div>
  
  <?php require ('footer.html');?>
</body>
</html>