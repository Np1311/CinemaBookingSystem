<?php require("../../view/header_login.php"); ?>
<html>
<head>
    <style>
        body {
            background-color: #e7dbd0;
        }
        
        .managerButton {
            margin-top: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .managerButton a {
            margin-bottom: 10px;
            text-decoration: none;
            width: 200px;
        }
        
        #bodyButton {
            background-color: #bd9a7a;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease, border 0.2s ease;
            width: 100%;
            border-radius: 5px; /* Added border-radius */
        }
        
        #bodyButton:hover {
            background-color: #fff;
            color: #bd9a7a;
            border: 2px solid;
        }
    </style>
</head>
<body>
    <div class="managerButton">
        <a href="manager_view_cinemaRoom.php">
            <button id="bodyButton">Manage Room</button>
        </a>

        <a href="manager_view_movie.php">
            <button id="bodyButton">Manage Movie</button>
        </a>

        <a href="manager_view_food.php">
            <button id="bodyButton">Manage Food</button>
        </a>
        <a href="manager_view_review.php">
            <button id="bodyButton">Manage review</button>
        </a>
    </div>
</body>
</html>
