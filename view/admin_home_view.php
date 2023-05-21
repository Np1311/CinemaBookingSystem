<?php
// Include the admin controller
require('../controller/admin_controller.php');

// Include the header login file
require('header_login.php');

// Create an instance of the admin controller
$admin = new admin_controller;

// Display all users
$admin->displayUser();

// $admin->displayUser('customer');
// $admin -> validateProfile('customer');

// Check if the deleteID parameter is set in the URL
if(isset($_GET['deleteID'])){
    // Get the user ID and current profile from the URL parameters
    $userID = $_GET['deleteID'];
    $curProfile = $_GET['curProfile'];
    // Call the suspendAccountController method of the admin controller
   if($admin->suspendAccountController($curProfile,$userID)){
    // Redirect to the admin home view if the account suspension is successful
        echo" <script>window.location='admin_home_view.php';</script>";
   }

}
?>
<html>
    <head>
    <style>
        .profileTable{
            margin-top: 100px;
        }
        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #bd9a7a;
            color:#fff;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
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
        }

        .btn-primary {
            background-color: #bd9a7a;
            color: #fff; /*button update */
        }

        .btn-primary:hover {
            background-color: #0062cc;
        }

        .btn-danger {
            background-color: #bd9a7a;
            color: #fff; /*button delete*/
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
            background-color: #bd9a7a; /*button add, edit, update*/
            color: #fff;
            cursor: pointer;
            /* transition: all 0.2s ease-in-out; */
            text-align: center;
            text-decoration: none;

        }

        #bodyButton:hover{
            background-color: white;
            color: #bd9a7a;
            border: 2px solid;
        }
        button:hover {
            background-color: #FFFFFF; 
            color: #0a0805;
        }
        body {
            background-color: #e7dbd0;
            font-family: arial;
         }


        @media screen and (max-width: 768px) {
            
        }

        .action-cell {
            text-align: center;
        } /*to make button mid connect to controller */

    </style>

        <title>HOME</title>
    </head>
    <body>
        <!--Display all of the buttons that leads to their respective functions-->
        <div class="adminButton">
            <a href="admin_create_profile.php">
                <button id='bodyButton'>Create Profile</button>
            </a> </br>

            <a href="admin_create_account.php">
                <button id='bodyButton'>Create Account</button>
            </a> </br>

            <a href="admin_suspend_profile.php">
                <button id='bodyButton'>Suspend Profile</button>
            </a> 
            <a href="admin_reactivate_profile.php">
                <button id='bodyButton'>Reactivate Profile</button>
            </a> 
            <a href="admin_search_profile.php">
                <button id='bodyButton'>Search Profile</button>
            </a> 
            <a href="admin_search_account.php">
                <button id='bodyButton'>Search Account</button>
            </a> 
            <a href="admin_update_profile.php">
                <button id='bodyButton'>Update Profile</button>
            </a> 
        </div>
    </body>
</html>