<?php
require('../controller/admin_controller.php');
$controller = new admin_controller;


?>
<html>
<head>
  <meta charset="utf-8">
  <title>Search Profile</title>
</head>
<body>
  <h1>Search Profile</h1>
  <form  method="post">
    <label for="profile">Profile:</label>
        <select name="profile">
            <?php
                $controller->showProfile();
            ?>
        </select>
    <select name="searchBy" id="searching">
        <option value="fname" default>First Name</option>
        <option value="lname">Last Name</option>
        <option value="phone">Phone</option>
        <option value="email">Email</option>
        <option value="dob">Date of Birth</option>                    
    </select> 
    <input type = 'text' name = 'searchAccount' placeholder="Enter YYYY-MM-DD for DOB" required></input>
    
    </br></br>
    <!-- <label for="search">Search:</label>
    <input type="text" id="search" name="searchAccount" placeholder="Enter search term..."> -->
    <button type="submit" name = 'submit'>Go</button>
  </form>
  <?php
    if(isset($_POST['submit'])){

        $searchAccount=$_POST['searchAccount'];
        $profile = $_POST['profile'];
        $searchBy = $_POST['searchBy'];

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
            echo '<td >
                <button class="btn btn-primary"><a href="../view/userUpdate.php?updateID='.$array['phone'].'&curProfile='.$profile.'"
                class="text-light">Update</a></button>
                <button class="btn-danger"><a href="../view/admin_home_view.php?deleteID='.$array['phone'].'&curProfile='.$profile.'" class="text-light">Delete</a></
                button> 
                </td>' ; 
            echo "</tr>";
        }
        
        // close the table
        echo "</table>";
        echo "</div>";
    }
  ?>
</body>
</html>