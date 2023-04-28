<?php
require('../controller/admin_controller.php');
$admin = new admin_controller;

// $admin->displayUser('system_admin');
// $admin->displayUser('customer');
?>
<html>
    <head>
    </head>
    <body>
        <form method='post' >
            </br></br>
            <div class="signIn" style="text-align:left;"> 
                <span class="input-group-text" id="phone">Profile Name</span>
                <input class="form-control" type="text" name="addProfile" id="addProfile" required>
            </div>
            </br>
            <button class="btn-primary" type ='submit' name='submit' value='submit'> Submit </button>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $newProfile = $_POST['addProfile'];
                if($admin -> validateProfile($newProfile)){
                    echo" <script>window.location='admin_home_view.php';</script>";
                }else{
                    echo '<script>alert("profile already listed")</script>';
                }
            }
        ?>
    </body>
</html>