<?php
require('../controller/admin_controller.php');

require('header.html');
$controller = new admin_controller;
?>

<html>
<head>
  <style>
    form {
      max-width: 600px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
      margin: 0 auto; /* Center the form horizontally */
      margin-bottom: 20px;
    }
    .container {
            display: flex;
            flex-direction: column;
            align-items: left;
            min-height: 100vh;
            padding: 20px;
            margin-top: 200px;
            margin-left: 70px;
        }

    body {
      background-color: #e7dbd0;
    }

    form input[type="text"] {
      width: 100%;
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

    form {
      width: 100%;
      max-width: 500px;
      margin-top:20px;
      margin-right:350px;
    }

    .button-container {
      display: flex;
      justify-content: space-between;
    }

    table {
  width: 90vw;
  height:100px;
  max-width: 800px;
  border-collapse: collapse;
  margin: 0 auto; /* Center the table horizontally */
  margin-top: 20px; /* Add margin at the top for spacing between form and table */
  margin-bottom: 20px;
}

table th,
table td {
  padding: 8px;
  border: 2px solid black;
  background-color:white;
}

table th {
  background-color: #bd9a7a;
  font-weight: bold;
}

table td {
  text-align: center;
}
  </style>

  <meta charset="utf-8">
  <title>Search Profile</title>
</head>
<body>
  <div class="container">
  <form method="post">
    <label for="search">Search Profile</label>
    <input type="text" id="search" name="search" placeholder="Enter search term...">
    <div class="button-container">
      <button type="submit" name="submit">Go</button>
      <button type="button" onclick="window.location.href = 'admin_home_view.php'">Back</button>
    </div>
  </form>
  
  <?php
  if(isset($_POST['submit'])){
      $searchProfile=$_POST['search'];

      if($controller->searchProfile($searchProfile) === false){
          echo '<script>alert("'.$searchProfile.' is not found")</script>';  
      } else {
          $profileArray = $controller->searchProfile($searchProfile);

          echo "<h2>$searchProfile</h2>";
          if(count($profileArray) > 0 ) {
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
                              echo '<td >
                                  <button class="btn btn-primary"><a href="../view/userUpdate.php?updateID='.$array['phone'].'&curProfile='.$searchProfile.'"
                                  class="text-light">Update</a></button>
                                  <button class="btn-danger"><a href="../view/admin_home_view.php?deleteID='.$array['phone'].'&curProfile='.$searchProfile.'" class="text-light">Delete</a></
                                  button> 
                                  </td>' ; 
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