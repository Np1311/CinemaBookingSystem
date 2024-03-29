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
body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  font-family: Arial;
  background-color: #e7dbd0;
}

.formContainer {
  width: 30%;
  padding: 10px;
  background-color: #fff;
  border-radius: 5px;
}

form {
  display: flex;
  flex-direction: column;
}

label {
  margin-top: 10px;
  margin-bottom: 5px;
  font-weight: bold;
}

select {
  padding: 5px;
  margin-bottom: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.btn-container {
  display: flex;
  justify-content: space-between;
}

.btn-primary {
  background-color: #bd9a7a;
  border: 2px solid #bd9a7a;
  color: white;
  padding: 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 8px;
  width: 48%;
  margin-top: 10px;
  cursor: pointer;
}

.btn-primary:hover {
  background-color: #fff;
  color: #bd9a7a;
  border: 2px solid;
}

    </style>
    <title>Admin Reactivate Profile</title>
</head>

<body>
  <!--Form to reactivate profile-->
  <div class='formContainer'>
    <form method="post">
      <label for="profile">Reactivate a Profile:</label></br>
      <select name="reactivate" required>
      <option value="" disabled selected>-- Choose a Profile --</option>
        <?php
        $controller->showProfile();
        ?>
      </select>
      <div class="btn-container">
        <button class="btn-primary" type='submit' name='submit' value='Submit'>Submit</button>
        <button class="btn-primary" type="button" onclick="window.location.href = 'admin_home_view.php'">Back</button>
      </div>
    </form>
  </div>
  <?php
  // Check if the form has been submitted
  if (isset($_POST['reactivate'])) {
    // Retrieve the reactivated profile value from the form
    $reactivateProfile = $_POST['reactivate'];
    // Output the reactivated profile value for testing
    echo $reactivateProfile;
    // Call the reactivateProfile method of the controller
    if ($controller->reactivateProfile($reactivateProfile)) {
      echo '<script>alert("' . $reactivateProfile . ' activated")</script>';
      echo " <script>window.location='../view/admin_home_view.php';</script>";
    }
  }
  ?>
</body>

</html>