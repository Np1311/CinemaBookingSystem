<?php
require('header.php');
session_start();

?>

<html>
    <head>
        <style>
            .formContainer{
                margin-top: 100px;
            }
            form {
            margin: 0 auto;
            width: 400px;
            font-family: Arial, sans-serif;
            }

            label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
            }

            input[type="text"],
            input[type="email"],
            input[type="tel"],
            input[type="date"],
            textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 16px;
            }

            select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 16px;
            }

            input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            }

            input[type="submit"]:hover {
            background-color: #45a049;
            }

            input[type="submit"]:active {
            background-color: #3e8e41;
            }

            input[type="submit"]:focus {
            outline: none;
            }

            .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            }
        </style>

    </head>
    <body>
        <div class = 'formContainer'>
            <form action="controler/signup_controller.php" method="post">
                <label for="fname">First Name:</label>
                <input type="text" id="fname" name="fname" required><br>

                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lname" required><br>

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required><br>

                <label for="membership">Membership Type:</label>
                <select id="membership" name="membership">
                    <option value="basic">Basic</option>
                    <option value="premium">Premium</option>
                    <option value="vip">VIP</option>
                </select><br>

                <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>