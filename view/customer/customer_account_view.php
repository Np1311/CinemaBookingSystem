<?php
session_start(); // Start the session

// Include the header file for the customer
require ('header_customer.html');
// Include the customer controller file
require('../../controller/customer_controller.php');

// Get the customer's phone number from the session
$phone =  $_SESSION['customerID'];
//Set profile to customer
$profile = 'customer';

//echo $customer -> getAccount();

// Check if the account exists in the controller
if($controller -> getAccount_controller($profile,$phone) == false){
  echo '<script>alert("No customer listed")</script>';
}else{
  // Get the customer account details as an array
  $array = $controller -> getAccount_controller($profile,$phone);
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>User Account</title>
  <style>
    /* General styles */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial;
      font-size: 16px;
      background-color: #e7dbd0;
    }
  
    /* Profile styles */
    .profile {
      max-width: 600px;
      margin: auto;
      margin-top : 100px !important;
      margin-bottom : 350px !important;
      padding: 20px;
      background-color: #f5f5f5;
      border: 1px solid #ccc;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }
    
    table {
      border-collapse: collapse;
      width: 100%;
      height:300px;
      margin-bottom:20px;
    }
    
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
      vertical-align: top;
      background-color: #e7dbd0;
      color:white;
    }
    
    th {
      background-color: #bd9a7a;
      font-weight: bold;
    }

    td {
      color:black;
      width:70%;
    }
    

  .custom-button {
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
    width: 200px;
    margin-left: 70px;
  }

  .custom-button:hover {
    border: 2px solid #bd9a7a;
    background-color: white;
    color: #bd9a7a;
  }

  .custom-button a {
    text-decoration: none;
    color: white;
  }

</style>
</head>
<body>
<?php
  // Assume we have fetched the user's profile data from a database
  ?>
  
  <div class="profile">
    <h1 style="text-align: center;">Account View</h1>
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
    <button class="custom-button" onclick="location.href='customer_update.php'">Edit Account</button>
    <button class="custom-button" onclick="location.href='customer_home_view.php'">Back</button>
  </div>
  
  <?php require ('../footer.html');?>
</body>


</html>