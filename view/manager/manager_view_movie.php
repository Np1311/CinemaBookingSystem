<?php
require('../../controller/manager_controller.php');



$arr = $controller -> viewMovieController();

?>

<html>
    <head>
    </head>
    <body>
        <div class="container">
            <div class="row">
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
                                <img src="<?php echo $array["movieBanner"];?>" style="width:100%; height:250px;" alt="Movie <?php echo $array["id"];?>"/> 
                                <h2 class="text-center mt-2" style="height:40px;"><?php echo $array["movieName"];?></h2>
                                <p><b>Release Date: </b> <?php echo $array['relDate']?></p>
                                
                                <p><b>Duration: </b> <?php echo $array["duration"];?> minutes</p>
                                <p><b>Genre: </b> <?php echo $array["genre"];?></p>
                                <p><b>Status: </b> <?php echo $array["status"];?></p>
                                <button class="btn btn-primary"><a href="../manager/manager_update_movie.php?updateID=<?php echo $array["id"];?>"
                                class="text-light">Update</a></button>
                                <button class="btn-danger"><a href="../manager/manager_delete_movie.php?deleteID=<?php echo $array["id"];?>" class="text-light">Delete</a></button> 
                            </div>
                        <?php
                    }
                }
                
                ?>

            </div>
        </div>
        <div class="adminButton">
            <a href="manager_create_movie.php">
                <button id='bodyButton'>Create Movie</button>
            </a> </br>

            <!-- <a href="manager_view_cinema.php">
                <button id='bodyButton'>View Cinema Room</button>
            </a> </br> -->

            <!--<a href="admin_delete_profile.php">
                <button id='bodyButton'>Delete profile</button>
            </a> 
            <a href="admin_reactivate_profile.php">
                <button id='bodyButton'>Reactivate profile</button>
            </a>  -->
        </div>
    </body>
</html>