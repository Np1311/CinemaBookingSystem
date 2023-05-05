<?php
require('../controller/admin_controller.php');
$admin = new admin_controller;

$admin->displayUser();
// $admin->displayUser('customer');
$admin = new admin_controller;
// $admin -> validateProfile('customer');
if(isset($_GET['deleteID'])){
   if($admin->deleteAccount()){
        echo" <script>window.location='admin_home_view.php';</script>";
   }

}
?>
<html>
    <head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            margin-right: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease-in-out;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0062cc;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .text-light {
            color: #fff;
        }

        .update-btn-container {
            display: flex;
            align-items: center;
        }

        .update-btn-container button:first-child {
            margin-right: 0;
        }

        @media screen and (max-width: 768px) {
            th, td {
                padding: 8px;
                font-size: 12px;
            }
            button {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
        .adminButton {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            height: 10vh;
        }

        #bodyButton {
            margin: 0 8px;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        button:hover {
            background-color: #0062cc;
        }

        @media screen and (max-width: 768px) {
            
        }
    </style>


    </head>
    <body>
        <div class="adminButton">
            <a href="admin_add_profile.php">
                <button id='bodyButton'>Add profile</button>
            </a> </br>

            <a href="admin_create_account.php">
                <button id='bodyButton'>Create account</button>
            </a> </br>

            <a href="admin_delete_profile.php">
                <button id='bodyButton'>Delete profile</button>
            </a> 
            <a href="admin_reactivate_profile.php">
                <button id='bodyButton'>Reactivate profile</button>
            </a> 
        </div>
    </body>
</html>