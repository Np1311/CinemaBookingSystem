<?php
require('../../controller/manager_controller.php');
require('../header.html');


if($arr = $controller -> viewMovieController()==false){
    $arr =[];
}else{
    $arr = $controller -> viewMovieController();
}

?>

<html>
    <head>
    <style>
        form {
            max-width: 410px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            margin: 0 auto; /* Center the form horizontally */
            margin-bottom: 30px;
            width: 100%;
            margin-top:20px;
            margin-left:1;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: left;
            min-height: 100vh;
            padding: 20px;
            margin-top: 200px;
            margin-left:0;
        }
        form input[type="text"] {
            width: 400px;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
        }

        form button[type="submit"],
        form button[type="button"] {
            background-color: #bd9a7a;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 48%;
            margin-top: 10px;
        }

        form button[type="submit"]:hover,
        form button[type="button"]:hover {
            background-color: white;
            color: #bd9a7a;
            border: 2px solid;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        body {
            background-color: #e7dbd0;
            font-family: Arial;
            margin-top: 11%;
        }

        .container {
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            margin-top: 100px;
            
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #bd9a7a;
            color: white;
            font-weight: bold;
        }

        table td {
            text-align: center;
        }

        .managerButton {
            text-align: center;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .managerButton a {
            margin: 10px;
            text-decoration: none;
        }

        .managerButton button {
            padding: 10px 20px;
            background-color: #bd9a7a;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .managerButton button:hover {
            background-color: white;
            color: #bd9a7a;
            border: 1px solid #bd9a7a;
        }

        .custom-button {
            flex: 1;
            margin: 0 5px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            background-color: #bd9a7a;
            color: white;
            border: none;
            font-size: 14px;
            text-decoration: none;
        }

        .custom-button:hover {
            background-color:white;
            color: #bd9a7a;
            border: 2px solid #bd9a7a;
        }

    </style>
    </head>
    <body>
        <div class="container">
        <form  method="post">
            <input type="text" name="searchInput" placeholder="Search...">
            <button type="submit" name='submit'>Search</button>
            <button type="submit" name="viewAll">View All</button>
        </form>
        <?php 
        if(isset($_POST['submit'])){
            $searchInput = $_POST['searchInput'];

            if($controller->searchMovieController($searchInput) == false){
                echo '<script>alert("'.$searchInput.' is not found")</script>';  
              }else{
                $arr = $controller->searchMovieController($searchInput);
              }
        }
        ?>
        
        <!--<form method="post">
            <button type="submit" name="viewAll">View All</button>
        </form>-->
        <?php

            if (isset($_POST['viewAll'])) {
                if($arr = $controller -> viewMovieController()==false){
                    $arr =[];
                }else{
                    $arr = $controller -> viewMovieController();
                }                
            }
        ?>
            <div class="row">
            <table>
                <thead>
                    <tr>
                    <th>Movie Banner</th>
                    <th>Movie Name</th>
                    <th>Release Date</th>
                    <th>Duration</th>
                    <th>Genre</th>
                    <th>Status</th>
                    <th>Room</th>
                    <th>Timings</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(count($arr) > 0)
                {
                    foreach($arr as $key => $array)
                    {
                        // $ind=$con->select("industry",$array["industry_id"]);
                        // $indrow=$ind->fetch_assoc();

                        // $lang=$con->select("language",$array["lang_id"]);
                        // $langrow=$lang->fetch_assoc();

                        // $gen=$con->select("genre",$array["genre_id"]);
                        // $genrow=$gen->fetch_assoc();


                        ?>
                            <div class="col-md-3">
                                <tr>
                                <td><img src="<?php echo $array["movieBanner"];?>" style="width:200px; height:250px;" alt="Movie <?php echo $array["movieID"];?>"/> </td>
                                <td><p> <?php echo $array["movieName"];?></p></td>
                                <td><p> <?php echo $array['relDate']?></p></td>
                                
                                <td><p> <?php echo $array["duration"];?> minutes</p></td>
                                <td><p> <?php echo $array["genre"];?></p></td>
                                <td><p> <?php echo $array["status"];?></p></td>
                                <td><p> <?php echo $array["roomName"];?></p></td>
                                <td>
                                    <p> <?php echo $array["timing1"];?></p>
                                    <p> <?php echo $array["timing2"];?></p>
                                    <p> <?php echo $array["timing3"];?></p>
                                    <p> <?php echo $array["timing4"];?></p>
                                </td>
                                <td><a href="../manager/manager_update_movie.php?updateID=<?php echo $array["movieID"];?>" class="custom-button">Update</a>
                                <a href="../manager/manager_delete_movie.php?deleteID=<?php echo $array["movieID"];?>" class="custom-button">Delete</a>
                                <a href="../manager/manager_movie_allocation.php?movieID=<?php echo $array["movieID"];?>" class="custom-button">Allocate Movie</a>
                                </tr>
                            </div>
                        <?php
                    }
                }
                
                ?>
                </tbody>
            </table>


        </div>
        <div class="managerButton">
            <a href="manager_create_movie.php">
                <button id='bodyButton'>Create Movie</button>
            </a> </br>

            <a href="manager_home_view.php">
                <button id='bodyButton'>Back</button>
            </a> </br>

            <!--<a href="admin_delete_profile.php">
                <button id='bodyButton'>Delete profile</button>
            </a> 
            <a href="admin_reactivate_profile.php">
                <button id='bodyButton'>Reactivate profile</button>
            </a>  -->
        </div>
       
        </div>
    </body>
</html>