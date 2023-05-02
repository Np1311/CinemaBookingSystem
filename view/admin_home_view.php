<?php
require('../controller/admin_controller.php');
$admin = new admin_controller;

$admin->displayUser();
// $admin->displayUser('customer');
$admin = new admin_controller;
// $admin -> validateProfile('customer');
if(isset($_GET['deleteID'])){
   $admin->deleteAccount(); 

}
?>
<html>
    <head>
    </head>
    <body>
        <a href="admin_add_profile.php">
            <button>Add profile</button>
        </a> </br>

        <a href="admin_add_account.php">
            <button>Add account</button>
        </a> </br>

        <a href="admin_delete_profile.php">
            <button>Delete profile</button>
        </a> 
    </body>
</html>