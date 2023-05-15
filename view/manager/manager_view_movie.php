<?php
require('../../controller/manager_controller.php');
// require('../header.html');


if($arr = $controller -> viewMovieController()==false){
    $arr =[];
}else{
    $arr = $controller -> viewMovieController();
}

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
                                <img src="<?php echo $array["movieBanner"];?>" style="width:100%; height:250px;" alt="Movie <?php echo $array["movieID"];?>"/> 
                                <h2 class="text-center mt-2" style="height:40px;"><?php echo $array["movieName"];?></h2>
                                <p><b>Release Date: </b> <?php echo $array['relDate']?></p>
                                
                                <p><b>Duration: </b> <?php echo $array["duration"];?> minutes</p>
                                <p><b>Genre: </b> <?php echo $array["genre"];?></p>
                                <p><b>Status: </b> <?php echo $array["status"];?></p>
                                <p><b>Room: </b> <?php echo $array["roomName"];?></p>
                                <p><b>Timing 1: </b> <?php echo $array["timing1"];?></p>
                                <p><b>Timing 2: </b> <?php echo $array["timing2"];?></p>
                                <p><b>Timing 3: </b> <?php echo $array["timing3"];?></p>
                                <p><b>Timing 4: </b> <?php echo $array["timing4"];?></p>
                                <button class="btn btn-primary"><a href="../manager/manager_update_movie.php?updateID=<?php echo $array["movieID"];?>"
                                class="text-light">Update</a></button>
                                <button class="btn-danger"><a href="../manager/manager_delete_movie.php?deleteID=<?php echo $array["movieID"];?>" class="text-light">Delete</a></button> 
                                <button class="btn-danger"><a href="../manager/manager_movie_allocation.php?movieID=<?php echo $array["movieID"];?>" class="text-light">Allocate Movie</a></button> 
                                <button type="btn-danger" onclick="window.location.href = 'manager_home_view.php'">Back</button>
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