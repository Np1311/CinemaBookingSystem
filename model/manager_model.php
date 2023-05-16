<?php
require('user_model.php');


class manager_model extends user_model{

    public function createRoom($roomName,$roomType, $roomCapacity, $totalRow, $totalColumn){
        global $conn;
        $conn -> select_db("CSIT314_Test");

        $sql = "CREATE TABLE IF NOT EXISTS cinemaRoom (
                roomID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                roomName VARCHAR(225) NOT NULL,
                roomType VARCHAR(225) NOT NULL,
                roomCapacity int(5) NOT NULL DEFAULT 0,
                totalRow int(3) NOT NULL DEFAULT 0,
                totalColumn int(3) NOT NULL DEFAULT 0,
                `status` VARCHAR(10) NOT NULL DEFAULT 'active'
                )";

        if ($conn->query($sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        $sql2 = "INSERT INTO cinemaRoom (roomName, roomType, roomCapacity, totalRow, totalColumn) VALUES ('$roomName', '$roomType', '$roomCapacity', '$totalRow', '$totalColumn');";

        try {
            mysqli_query($conn, $sql2); 
            echo '<script>alert("good to go")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
        return false;}

    }

    public function viewRoom(){
        global $conn;
        $conn->select_db("CSIT314_Test");
        
        try {
            $sql2 = "SELECT * FROM cinemaRoom;";
            $result2 = $conn->query($sql2);
            if (!$result2) {
                throw new Exception("Failed to execute query: " . $conn->error);
            }
            $array = array();
            while ($row = mysqli_fetch_assoc($result2)) {
                $array[] = $row;
            }
            return $array;
        } catch (Exception $e) {
            // Handle the exception here
            echo "Error: " . $e->getMessage();
            return array();
        }
        

    }

    public function deleteRoom($deleteID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        $sql = "UPDATE cinemaRoom SET `status` = 'suspend' WHERE roomID = '$deleteID';";

        try {
            mysqli_query($conn, $sql); 
            
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
        return false;
        }
    }

    public function getRoom($updateID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        $sql = "SELECT * FROM `cinemaRoom` WHERE roomID = '$updateID';";

        $result = $conn->query($sql);

        // check if the query was successful
        if (!$result) {
        echo "Error: " . $conn->error;
        exit();
        }

        // fetch the result row as an associative array
        
        while ($row = mysqli_fetch_assoc($result) ) {
            $arr = $row;
        }

        return $arr;
    }

    public function updateRoom($updateID,$roomName,$roomType,$roomCapacity,$totalRow,$totalColumn,$status){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        
        $sql =" UPDATE `cinemaRoom` SET `roomName`='$roomName',`roomType`='$roomType',`roomCapacity`='$roomCapacity',`totalRow`='$totalRow', `totalColumn`='$totalColumn' ,`status`='$status' WHERE roomID = '$updateID';";

        try {
            mysqli_query($conn, $sql); 
            
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error creating user")</script>'; 
        return false;}
    }

    public function createMovie($movieName,$movieBanner, $relDate, $genre, $duration){
        global $conn;
        $conn->select_db('CSIT314_Test');

        $sql = "CREATE TABLE IF NOT EXISTS cinemaMovie (
            movieID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            movieName VARCHAR(225) NOT NULL,
            movieBanner VARCHAR(225) NOT NULL,
            relDate date NOT NULL,
            genre VARCHAR(225) NOT NULL,
            duration INT(4) NOT NULL,
            `status` VARCHAR(10) NOT NULL DEFAULT 'active')";

            if ($conn->query($sql) === TRUE) {
                echo "Table created successfully";
            } else {
                echo "Error creating table: " . $conn->error;
            }
        $sql2 = "CREATE TABLE IF NOT EXISTS cinemaAllocation (
            allocationID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            movieID INT(11) UNSIGNED NOT NULL,
            roomID INT(6) UNSIGNED NOT NULL,
            timing1 VARCHAR(255) DEFAULT NULL,
            timing2 VARCHAR(255) DEFAULT NULL,
            timing3 VARCHAR(255) DEFAULT NULL,
            timing4 VARCHAR(255) DEFAULT NULL,
            FOREIGN KEY (movieID) REFERENCES cinemaMovie(movieID),
            FOREIGN KEY (roomID) REFERENCES cinemaRoom(roomID)
        );";

        if ($conn->query($sql2) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
            $mysql_date = date('Y-m-d', strtotime($relDate));

            $sql3 = "INSERT INTO cinemaMovie (movieName, movieBanner, relDate, genre, duration) VALUES ('$movieName', '$movieBanner', '$mysql_date', '$genre', '$duration');";

            try {
                mysqli_query($conn, $sql3); 
                echo '<script>alert("good to go")</script>'; 
                return true; 
            }
            catch(mysqli_sql_exception $e) {
                die("Error creating user: " . mysqli_error($conn)); 
                echo '<script>alert("error updating user")</script>'; 
                return false;
            }
    }
    public function getMovie(){
        global $conn;
        $conn->select_db("CSIT314_Test");

        //$sql = "SELECT * FROM `cinemaMovie` ";
        try {
            $sql = "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status, r.roomName, a.timing1, a.timing2, a.timing3, a.timing4
                    FROM cinemaMovie m
                    LEFT JOIN cinemaAllocation a ON a.movieID = m.movieID
                    LEFT JOIN cinemaRoom r ON r.roomID = a.roomID;";
            $result = $conn->query($sql);
            if (!$result) {
                throw new Exception("Failed to execute query: " . $conn->error);
                $array = [];
            }
            $array = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $array[] = $row;
            }
            return $array;
        } catch (Exception $e) {
            // Handle the exception here
            echo "Error: " . $e->getMessage();
        }
        

    
    }

    public function updateMovie($updateID,$movieName,$movieBanner, $relDate, $genre, $duration, $status, $roomID, $timing1,$timing2,$timing3,$timing4){
        global $conn;
        $conn -> select_db("CSIT314_Test");
     
        
        $sql =" UPDATE `cinemaMovie` SET `movieName`='$movieName',`movieBanner`='$movieBanner',`relDate`='$relDate',`genre`='$genre', `duration`='$duration' ,`status`='$status' WHERE movieID = '$updateID';";
        $sql2 = "UPDATE `cinemaAllocation` SET `roomID` = '$roomID', `timing1`='$timing1', `timing2`='$timing2', `timing3`='$timing3', `timing4`='$timing4' WHERE movieID = '$updateID' ; ";
        try {
            mysqli_query($conn, $sql); 
            mysqli_query($conn, $sql2); 
            
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error creating user")</script>'; 
        return false;}
    }
    
    public function movieDetail($updateID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        //$sql = "SELECT * FROM `cinemaMovie` WHERE movieID = '$updateID';";
        $sql =  "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status, r.roomID, 
        a.timing1, a.timing2, a.timing3, a.timing4
        FROM cinemaMovie m
        LEFT JOIN cinemaAllocation a ON a.movieID = m.movieID
        LEFT JOIN cinemaRoom r ON r.roomID = a.roomID
        WHERE m.movieID = '$updateID';";
 

        $result = $conn->query($sql);

        // check if the query was successful
        if (!$result) {
        echo "Error: " . $conn->error;
        exit();
        }

        // fetch the result row as an associative array
        
        while ($row = mysqli_fetch_assoc($result) ) {
            $array = $row;
        }

        return $array;
    }

    public function deleteMovie($deleteID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        $sql = "UPDATE cinemaMovie SET `status` = 'suspend' WHERE movieID = '$deleteID';";

        try {
            mysqli_query($conn, $sql); 
            
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
        return false;
        }
    }

    public function allocateMovie($movieID,$roomID,$timing1,$timing2,$timing3,$timing4){
        global $conn;
        $conn->select_db("CSIT314_Test");

        

        $sql2 = "INSERT INTO `cinemaAllocation`(`movieID`, `roomID`, `timing1`, `timing2`, `timing3`, `timing4`) VALUES ('$movieID','$roomID','$timing1','$timing2','$timing3','$timing4')";
        try {
            mysqli_query($conn, $sql2); 
            
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
        return false;
        }
    }

    public function createFood($foodName,$description, $price, $category, $stock, $image){
        global $conn;
        $conn->select_db("CSIT314_Test");

        $sql = "CREATE TABLE IF NOT EXISTS cinemaFoodAndDrink (
            foodID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            foodName VARCHAR(255) NOT NULL,
            foodDescription VARCHAR(1000),
            price DECIMAL(10,2) NOT NULL,
            category VARCHAR(50),
            stock INT(5) NOT NULL DEFAULT 0,
            `image` VARCHAR(255),
            `status` VARCHAR(10) NOT NULL DEFAULT 'active'
          );";
        if ($conn->query($sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
        $sql2 = "INSERT INTO cinemaFoodAndDrink (foodName, foodDescription, price, category, stock, `image`) VALUES ('$foodName', '$description', '$price', '$category', '$stock', '$image');";

        try {
            mysqli_query($conn, $sql2); 
            echo '<script>alert("good to go")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }
    }

    public function viewFoodAndDrink(){
        global $conn;
        $conn->select_db("CSIT314_Test");
        
        try {
            $sql = "SELECT * FROM cinemaFoodAndDrink;";
            $result = $conn->query($sql);
        
            if (!$result) {
                throw new Exception("Failed to execute query: " . $conn->error);
            }
        
            $array = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $array[] = $row;
            }
        
            return $array;
        } catch (Exception $e) {
            // Handle the exception here
            echo "Error: " . $e->getMessage();
            return array();
        }
        

    }

    public function getFoodAndDrink($updateID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        $sql = "SELECT * FROM `cinemaFoodAndDrink` WHERE foodID = '$updateID';";

        $result = $conn->query($sql);

        // check if the query was successful
        if (!$result) {
        echo "Error: " . $conn->error;
        exit();
        }

        // fetch the result row as an associative array
        
        while ($row = mysqli_fetch_assoc($result) ) {
            $arr = $row;
        }

        return $arr;
    }
    public function updateFoodAndDrink($updateID,$foodName,$description, $price, $category, $stock, $image, $status){
        global $conn;
        $conn->select_db("CSIT314_Test");

        $sql = "UPDATE cinemaFoodAndDrink SET foodName = '$foodName', foodDescription = '$description' , price = '$price', category = '$category', stock = '$stock', `image`='$image', `status` = '$status' WHERE foodID = '$updateID';";

        try {
            mysqli_query($conn, $sql); 
            
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
        return false;
        }
    }
    public function deleteFood($deleteID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        $sql = "UPDATE cinemaFoodAndDrink SET `status` = 'suspend' WHERE foodID = '$deleteID';";

        try {
            mysqli_query($conn, $sql); 
            
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
        return false;
        }
    }


}


?>