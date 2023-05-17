<?php
session_start();
?>
<html>
<head>
    
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <style>
        .header {
            background: #bd9a7a;
            color: white;
            font-size: 20px;
            width: 100%;
            height: 50px;
            position: fixed;
            top: 0;
            left: 0;
            font-family: Arial;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            z-index: 999;
        }

        .header-image {
            height: 50px;
            margin-right: 10px;
        }

        .logoAndName {
            display: flex;
            align-items: center;
            margin-left: 5px;
        }

        .logoAndName h2 {
            margin: 0;
            color: #FFFFFF;
        }

        .logoAndName h2 a{
            color: white;
        }

        .logoutbtn {
            display: flex;
            align-items: center;
            gap:10px;
        }

        .logout {
            background-color: #0a0805;
            color: #FFFFFF;
            padding: 10px 20px;
            font-size: 20px;
            border: none;
            margin-top: 4px;
            font-family: Arial;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 20px;
        }

        .back {
            background-color: #fff;
            color: #0a0805;
            padding: 10px 20px;
            font-size: 20px;
            border: none;
            margin-top: 4px;
            font-family: Arial;
            border-radius: 5px;
            cursor: pointer;
            /* margin-left: 20px; */
            /* margin-right: 20px; */
        }

        .logout:hover {
            background-color: #FFFFFF;
            color: #0a0805;
        }

        .back:hover {
            background-color: #0a0805;
            color: #ffff;
        }
    </style>
</head>
<body>
<div class="header">
    <div class='logoAndName'>
        <img src="../cap.png" alt="Your Image" class="header-image">
        <h2><a href="index.php" id="home">CAPYBARA CINEMA</a></h2>
    </div>
    <div class='logoutbtn'>
        <?php
        if ($_SESSION['profile'] == 'system_admin') {
            ?>
            <button class="back" onclick="location.href='../view/admin_home_view.php'">Home</button>
            <button class="logout" onclick="location.href='../controller/logout.php'">Log Out</button>
            <?php
        }
        ?>
        <?php
        if ($_SESSION['profile'] == 'manager') {
            ?>
            <button class="back" onclick="location.href='../manager/manager_home_view.php'">Home</button>
            <button class="logout" onclick="location.href='../../controller/logout.php'">Log Out</button>
            <?php
        }
        ?>
        <?php
        if ($_SESSION['profile'] == 'customer') {
            ?>
            <button class="back" onclick="location.href='../customer/customer_home_view.php'">Home</button>
            <button class="logout" onclick="location.href='../../controller/logout.php'">Log Out</button>
            <?php
        }
        ?>
    </div>
</div>
<script>
    function goBack() {
        window.history.go(-1);
    }
</script>
</body>
</html>
