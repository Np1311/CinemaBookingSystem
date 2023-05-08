<?php
require('../controller/admin_controller.php');
require('header.html');
$controller = new admin_controller;


?>
<html>
<head>

<style>

form {
    max-width: 1000px; /*New things */
    margin: 0 auto; /* Set left and right margin to auto */
    background-color: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    position: absolute; /* Position the form absolutely */
    top: 50%; /* Set the top position to 50% of the screen height */
    left: 50%; /* Set the left position to 50% of the screen width */
    transform: translate(-50%, -50%); /* Use the transform property to center the form */
  }

body{
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
  /* padding: 5px 10px; */
  padding: 10px; /*kumar modified*/
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: white;
  color: #bd9a7a;
  border: 2px solid;
}


/*the code i implemented kumar*/
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

</style>
<meta charset="utf-8">
<title>Search Profile</title>
</head>
<body>
  <h1>Search Profile</h1>
  <form  method="post">
    <label for="profile">Profile:  </label>
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
    <!---kumar added the size to the textbox-->

    <input type = 'text' name = 'searchAccount' placeholder="Enter YYYY-MM-DD for DOB" size='25' required></input>
    
    </br></br>
    <!-- <label for="search">Search:</label>
    <input type="text" id="search" name="searchAccount" placeholder="Enter search term..."> -->
    <button type="submit" name = 'submit'>Go</button>
    <button type="button" onclick="history.go(-1)">Back</button>
    
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