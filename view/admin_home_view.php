<?php
require('../controller/admin_controller.php');
$admin = new admin_controller;

$admin->displayUser();
// $admin->displayUser('customer');
?>
<html>
    <head>
    </head>
    <body>
        <a href="admin_add_profile.php">
            <button>Add profile</button>
        </a> 
    </body>
</html>