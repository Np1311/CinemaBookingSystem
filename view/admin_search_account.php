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
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
}

body {
    background-color: #e7dbd0;
}

form button {
    background-color: #bd9a7a;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
}

button[type="submit"] {
    background-color: #bd9a7a;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: white;
    color: #bd9a7a;
    border: 2px solid;
}

button[type="button"] {
    background-color: #bd9a7a;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="button"]:hover {
    background-color: white;
    color: #bd9a7a;
    border: 2px solid;
}

form label {
    display: block;
    margin-bottom: 8px;
}

form select,
form input[type="text"] {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 16px;
    box-sizing: border-box; /* Add this line */
}

form input[type="text"] {
    min-width: 200px;
}

form .btn-group {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

form .btn-group button {
    flex-basis: 48%;
}

h1 {
    text-align: center;
}

table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

table th,
table td {
    padding: 8px;
    border: 2px solid black;
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
<title>Search Account</title>
</head>
<body>
  <h1>Search Account</h1>
  <form method="post">
    <label for="profile">Profile:</label>
    <select name="profile">
        <option value="" disabled selected> --Choose a Profile-- </option>
        <?php
            $controller->showProfile();
        ?>
    </select>
    <select name="searchBy" id="searching">
        <option value="" disabled selected> --Choose a Filter-- </option>
        <option value="fname">First Name</option>
        <option value="lname">Last Name</option>
        <option value="phone">Phone</option>
        <option value="email">Email</option>
    </select>
    <input type="text" name="searchAccount" placeholder="Enter Data" required>
    </br></br>
    <div class="btn-group">
        <button type="submit" name="submit">Go</button>
        <button type="button" onclick="window.location.href = 'admin_home_view.php'">Back</button>
</div>

  </form>
  <?php
    if(isset($_POST['submit'])){
        $searchAccount = $_POST['searchAccount'];
        $profile = $_POST['profile'];
        $searchBy = $_POST['searchBy'];
        if($controller->searchAccount($profile,$searchAccount,$searchBy) == false){
          echo '<script>alert("'.$searchAccount.' is not found")</script>';  
        }else{
        $accountArray = $controller->searchAccount($profile,$searchAccount,$searchBy);
    
        echo "<h2>$profile</h2>";
        echo "<table>";
        echo "<tr><th>First name</th><th>Last name</th><th>Phone</th><th>Email</th><th>Password</th><th>Date of Birth</th><th>Status</th><th>Action</th></tr>";
    
        // loop through results and display in table rows
        foreach($accountArray as $key => $array){
            echo "<tr>";
            echo "<td>" . $array['fname'] . "</td>";
            echo "<td>" . $array['lname'] . "</td>";
            echo "<td>" . $array['phone'] . "</td>";
            echo "<td>" . $array['email'] . "</td>";
            echo "<td>" . $array['password'] . "</td>";
            echo "<td>" . $array['dob'] . "</td>";
            echo "<td>" . $array['status'] . "</td>";
            echo '<td>
                <button class="btn btn-primary"><a href="../view/userUpdate.php?updateID='.$array['phone'].'&curProfile='.$profile.'" class="text-light">Update</a></button>
                <button class="btn-danger"><a href="../view/admin_home_view.php?deleteID='.$array['phone'].'&curProfile='.$profile.'" class="text-light">Delete</a></button>
                </td>';
            echo "</tr>";
        }
        
        // close the table
        echo "</table>";
        echo "</div>";
        }
    }
    ?>
    </body>
    </html>