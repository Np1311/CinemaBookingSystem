<?php
require('../../controller/manager_controller.php');
//require('header.html');

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
    margin-top: 10%;
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
    margin-top: 10px;
}

form .btn-group button {
    flex-basis: 48%;
}

/* h1 {
    text-align: center;
} */

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
<title>Search an Account</title>
</head>
<body>
  <!-- <h1>Search Account</h1> -->
  <form method="post">
    <label for="searchRoom">Search a Room:</label><br>
    
    <select name="searchBy" id="searching">
        <option value="" disabled selected> --Choose a Filter-- </option>
        <option value="roomName">Room Name</option>
        <option value="roomType">Room Type</option>
    </select></br></br>
    <input type="text" name="searchInput" placeholder="Enter Data" required>
    </br></br>
    <div class="btn-group">
        <button type="submit" name="submit">Go</button>
        <button type="button" onclick="window.location.href = 'manager_home_view.php'">Back</button>
</div>

  </form>
  <?php
    if(isset($_POST['submit'])){
        $searchInput = $_POST['searchInput'];
        
        $searchBy = $_POST['searchBy'];
        if($controller->getRoomDetailController($searchInput,$searchBy) == false){
          echo '<script>alert("'.$searchInput.' is not found")</script>';  
        }else{
        $roomArray = $controller->getRoomDetailController($searchInput,$searchBy);
        echo '<div>';
        echo "<table>";
        echo "<tr>
            <th>ID</th>
            <th>Room Name</th>
            <th>Room Type</th>
            <th>Room Capacity</th>
            <th>Total Row</th>
            <th>Total Column</th>
            <th>Status</th>
            <th>Action</th>
            </tr>";
    
        // loop through results and display in table rows
        foreach($roomArray as $key => $array){
            echo "<tr>";
                echo "<td>" . $array['roomID'] . "</td>";
                echo "<td>" . $array['roomName'] . "</td>";
                echo "<td>" . $array['roomType'] . "</td>";
                echo "<td>" . $array['roomCapacity'] . "</td>";
                echo "<td>" . $array['totalRow'] . "</td>";
                echo "<td>" . $array['totalColumn'] . "</td>";
                echo "<td>" . $array['status'] . "</td>";
                echo '<td>
                        <button class="btn btn-primary">
                            <a href="../manager/manager_update_cinema.php?updateID=' . $array['roomID'] . '" class="text-light">Update</a>
                        </button>
                        <button class="btn-danger">
                            <a href="../manager/manager_delete_cinema.php?deleteID=' . $array['roomID'] . '" class="text-light">Delete</a>
                        </button>
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