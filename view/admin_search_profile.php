<?php
// Include the admin controller
require('../controller/admin_controller.php');
// Include the header file
require('header.html');
// Create an instance of the admin controller
$controller = new admin_controller;
?>

<html>
<head>
  <style>
    form {
      max-width: 400px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
      margin: 0 auto; /* Center the form horizontally */
      margin-bottom: 30px;
      width: 100%;
      margin-top:20px;
      margin-left:1;
    }
    .container {
            display: flex;
            flex-direction: column;
            align-items: left;
            min-height: 100vh;
            padding: 20px;
            margin-top: 200px;
            margin-left:0;
        }
    .button-container {
    display: flex;
    justify-content: space-between;
    }

    body {
      background-color: #e7dbd0;
      font-family: arial;
    }

    form input[type="text"] {
      width: 400px;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
      font-size: 16px;
      box-sizing: border-box;
    }

    form button[type="submit"],
    form button[type="button"] {
      background-color: #bd9a7a;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 48%; /* Adjusted width to fit side by side */
      margin-top: 10px;
    }

    form button[type="submit"]:hover,
    form button[type="button"]:hover {
      background-color: white;
      color: #bd9a7a;
      border: 2px solid;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

  
    .button-container {
      display: flex;
      justify-content: space-between;
    }

  table {
    height:100px;
    width: 1300px;
    border-collapse: collapse;
    margin: 0 auto; /* Center the table horizontally */
    margin-top: 10px; /* Add margin at the top for spacing between form and table */
    margin-bottom: 20px;
    margin-right:20px;
  }

table th,
table td {
  width:350px;
  padding: 10px;
  border: 2px solid #ddd;
  background-color:white;
}

table th {
  background-color: #bd9a7a;
  font-weight: bold;
  color:white;
}

table td {
  text-align: center;
}

.custom-button {
  flex: 1;
  margin: 0 5px;
  padding: 10px;
  border-radius: 5px;
  cursor: pointer;
  background-color: #bd9a7a;
  color: black;
  border: none;
  font-size: 14px;
}

.custom-button:hover {
  background-color:white;
  color: #bd9a7a;
  border: 1px solid #bd9a7a;
}
.custom-button a {
  text-decoration: none;
  color: black;
}

  </style>

  <meta charset="utf-8">
  <title>Search Profile</title>
</head>
<body>
  <div class="container">
  <form method="post">
    <label for="search">Search Profile:</label></br></br>
    <input type="text" id="search" name="search" placeholder="Enter search term..."required> 
    <div class="button-container">
      <button type="submit" name="submit">Go</button>
      <button type="button" onclick="window.location.href = 'admin_home_view.php'">Back</button>
    </div>
  </form>
  
  <?php
  if(isset($_POST['submit'])){
      // Retrieve the profile from the form
      $profile=$_POST['search'];
      // Check if the profile exists
      if($controller->searchProfile($profile) === false){
          echo '<script>alert("'.$profile.' is not found");</script>';  
      } else {
          // Get the profile array from the searchProfile method
          $profileArray = $controller->searchProfile($profile);
          // Display the profile title
          echo "<h2>$profile</h2>";
          // Check if there are results in the profile array
          if(count($profileArray) > 0 ) {
            // Display a table for the profile results
              echo "<table>";
              echo "<tr><th>First name</th><th>Last name</th><th>Phone</th><th>Email</th><th>Password</th><th>Date of Birth</th><th>Status</th><th>Action</th></tr>";

            // loop through results and display in table rows
                            foreach($profileArray as $key => $array){
                              echo "<tr>";
                              echo "<td>" . $array['fname'] . "</td>";
                              echo "<td>" . $array['lname'] . "</td>";
                              echo "<td>" . $array['phone'] . "</td>";
                              echo "<td>" . $array['email'] . "</td>";
                              echo "<td>" . $array['password'] . "</td>";
                              echo "<td>" . $array['dob'] . "</td>";
                              echo "<td>" . $array['status'] . "</td>";
                              echo '<td>
                                    <div class="button-container">
                                      <button class="custom-button">
                                        <a href="../view/userUpdate.php?updateID='.$array['phone'].'&curProfile='.$profile.'" class="text-light">Update</a>
                                      </button>
                                      <button class="custom-button">
                                        <a href="../view/admin_home_view.php?deleteID='.$array['phone'].'&curProfile='.$profile.'" class="text-light">Suspend</a>
                                      </button>
                                    </div>
                                  </td>';
                              echo "</tr>";
                          }
                          
                          // close the table
                          echo "</table>";
                      } else {
                          echo "<p>No results found.</p>";
                      }
                  }
              }
              ?>
              </div>
            </body>
            </html>            