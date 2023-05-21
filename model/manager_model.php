<?php
require('user_model.php');


class manager_model extends user_model{

    public function createRoom($roomName,$roomType, $roomCapacity, $totalRow, $totalColumn){
        global $conn;
        $conn -> select_db("CSIT314_Test");

        // Create the cinemaRoom table if it doesn't exist
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
            // echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        // Insert the room data into the cinemaRoom table
        $sql2 = "INSERT INTO cinemaRoom (roomName, roomType, roomCapacity, totalRow, totalColumn) VALUES ('$roomName', '$roomType', '$roomCapacity', '$totalRow', '$totalColumn');";

        try {
            // Execute the SQL query
            mysqli_query($conn, $sql2); 

             // Room created successfully
            echo '<script>alert("Room : '.$roomName.' created Successfully")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            // An error occurred while creating the room
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
        return false;}

    }

    //Function to viewRoom
    public function viewRoom(){
        global $conn;
        $conn->select_db("CSIT314_Test");
        
        try {
            // Retrieve all room data from the cinemaRoom table
            $sql2 = "SELECT * FROM cinemaRoom;";
            $result2 = $conn->query($sql2);

            // Check if the query was successful
            if (!$result2) {
                throw new Exception("Failed to execute query: " . $conn->error);
            }
            // Create an array to store the room data
            $array = array();
            // Iterate through the result set and store each row in the array
            while ($row = mysqli_fetch_assoc($result2)) {
                $array[] = $row;
            }
            // Return the array of room data
            return $array;
        } catch (Exception $e) {
            // Handle the exception here
            echo "Error: " . $e->getMessage();
            // Return an empty array in case of error
            return array();
        }
        

    }
    //Function to view active room
    public function viewActiveRoom(){
        global $conn;
        $conn->select_db("CSIT314_Test");
        
        try {
            // Retrieve active room data from the cinemaRoom table
            $sql2 = "SELECT * FROM cinemaRoom WHERE status = 'active';";
            $result2 = $conn->query($sql2);
            // Check if the query was successful
            if (!$result2) {
                throw new Exception("Failed to execute query: " . $conn->error);
            }
            // Create an array to store the room data
            $array = array();

            // Iterate through the result set and store each row in the array
            while ($row = mysqli_fetch_assoc($result2)) {
                $array[] = $row;
            }
            // Return the array of active room data
            return $array;
        } catch (Exception $e) {
            // Handle the exception here
            echo "Error: " . $e->getMessage();
            // Return an empty array in case of error
            return array();
        }
        

    }
    //Function to delete room
    public function deleteRoom($deleteID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        // Update the status of the room to 'suspend' in the cinemaRoom table
        $sql = "UPDATE cinemaRoom SET `status` = 'suspend' WHERE roomID = '$deleteID';";

        try {
            // Execute the SQL query
            mysqli_query($conn, $sql); 
            
            // Room deletion successful
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            // An error occurred while deleting the room
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
        return false;
        }
    }

    //Function to retrieve room
    public function getRoom($updateID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        // Retrieve the room data from the cinemaRoom table based on roomID
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
        // Return the room data
        return $arr;
    }
    // Function to update room details
    public function updateRoom($updateID,$roomName,$roomType,$roomCapacity,$totalRow,$totalColumn,$status){
        global $conn;
        $conn -> select_db("CSIT314_Test");
        
        // Update the room information in the cinemaRoom table based on roomID
        $sql =" UPDATE `cinemaRoom` SET `roomName`='$roomName',`roomType`='$roomType',`roomCapacity`='$roomCapacity',`totalRow`='$totalRow', `totalColumn`='$totalColumn' ,`status`='$status' WHERE roomID = '$updateID';";

        try {
            // Execute the SQL query
            mysqli_query($conn, $sql); 
            
            // Room update successful
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            // An error occurred while updating the room
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error creating user")</script>'; 
        return false;}
    }
    //Function to create movie
    public function createMovie($movieName,$movieBanner, $relDate, $genre, $duration){
        global $conn;
        $conn->select_db('CSIT314_Test');

        // Create cinemaMovie table if it doesn't exist
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
            // Create cinemaAllocation table if it doesn't exist
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

            // Insert the movie data into the cinemaMovie table
            $sql3 = "INSERT INTO cinemaMovie (movieName, movieBanner, relDate, genre, duration) VALUES ('$movieName', '$movieBanner', '$mysql_date', '$genre', '$duration');";

            try {
                mysqli_query($conn, $sql3); 
                echo '<script>alert("Movie '.$movieName.' created successfully")</script>'; 
                return true; 
            }
            catch(mysqli_sql_exception $e) {
                die("Error creating user: " . mysqli_error($conn)); 
                echo '<script>alert("error updating user")</script>'; 
                return false;
            }
    }
    //Function to retrieve movie details
    public function getMovie(){
        global $conn;
        $conn->select_db("CSIT314_Test");

        //$sql = "SELECT * FROM `cinemaMovie` ";
        try {
            // Retrieve movie data along with room and timing information
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
            // echo "Error: " . $e->getMessage();
            return array();
        }
        

    
    }
    //Function to update movie details
    public function updateMovie($updateID,$movieName,$movieBanner, $relDate, $genre, $duration, $status, $roomID, $timing1,$timing2,$timing3,$timing4){
        global $conn;
        $conn -> select_db("CSIT314_Test");
     
        // Update cinemaMovie table
        $sql =" UPDATE `cinemaMovie` SET `movieName`='$movieName',`movieBanner`='$movieBanner',`relDate`='$relDate',`genre`='$genre', `duration`='$duration' ,`status`='$status' WHERE movieID = '$updateID';";
        // Update cinemaAllocation table
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
    //Function to retrieve movie details
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
    //Function to delete movie
    public function deleteMovie($deleteID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        // Set the status of the movie to 'suspend'
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
    //Function to allocate movie
    public function allocateMovie($movieID,$roomID,$timing1,$timing2,$timing3,$timing4){
        global $conn;
        $conn->select_db("CSIT314_Test");

        
        // Insert a new record into cinemaAllocation table
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
    //Function to create food
    public function createFood($foodName,$description, $price, $category, $stock, $image){
        global $conn;
        $conn->select_db("CSIT314_Test");

        // Create cinemaFoodAndDrink table if it doesn't exist
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
        // Insert a new record into cinemaFoodAndDrink table
        $sql2 = "INSERT INTO cinemaFoodAndDrink (foodName, foodDescription, price, category, stock, `image`) VALUES ('$foodName', '$description', '$price', '$category', '$stock', '$image');";

        try {
            mysqli_query($conn, $sql2); 
            echo '<script>alert("Food/Drink created successfully")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }
    }
    //Function to view all the food and drinks
    public function viewFoodAndDrink(){
        global $conn;
        $conn->select_db("CSIT314_Test");
        
        try {
            // Select all records from cinemaFoodAndDrink table
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
    //Function to select food and drink
    public function getFoodAndDrink($updateID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        // SQL query to select food and drink with the specified ID
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
    //Function to update the food and drinks
    public function updateFoodAndDrink($updateID,$foodName,$description, $price, $category, $stock, $image, $status){
        global $conn;
        $conn->select_db("CSIT314_Test");

        // SQL query to update the food and drink entry with the specified ID
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
    //Function to delete food
    public function deleteFood($deleteID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        // SQL query to update the status of the food and drink entry with the specified ID
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
    //Function to view rooms
    public function viewReview(){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            // SQL query to retrieve review information from multiple tables
            $sql = "SELECT c.fname, c.lname, c.phone, b.total_amnt, b.numOfTicket, cr.movieName, cr.showTiming, cr.rating, cr.review, b.bookingDate
            FROM customer c
            JOIN booking b ON c.phone = b.phone
            JOIN (
              SELECT cr.bookingID, cr.movieName, cr.showTiming, cr.rating, cr.review
              FROM customerReview cr
            ) cr ON cr.bookingID = b.bookingID;";
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
    //Function to retrieve year
    public function getYear(){
        global $conn;
        $conn -> select_db('CSIT314_Test');

        // SQL query to retrieve distinct years from the booking table
        $sql ="SELECT DISTINCT YEAR(bookingDate) AS bookingYear
        FROM booking;";
         try {
            $sql ="SELECT DISTINCT YEAR(bookingDate) AS bookingYear
            FROM booking;";
            $result = $conn->query($sql);
        
            if (!$result) {
                throw new Exception("Failed to execute query: " . $conn->error);
            }
        
            $array = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $array[] = $row['bookingYear'];
            }
        
            return $array;
        } catch (Exception $e) {
            // Handle the exception here
            echo "Error: " . $e->getMessage();
            return array();
        }


    }
    //Function to generate monthly report
    public function  generateMonthlyReport($year,$month){
        global $conn;
        $conn -> select_db('CSIT314_Test');

        try {
            // SQL query to retrieve movieName, month, totalTickets, and totalAmount for a specific year and month
            $sql = "SELECT movieName, MONTH(bookingDate) AS month, SUM(numOfTicket) AS totalTickets, SUM(total_amnt) AS totalAmount
                    FROM booking
                    WHERE YEAR(bookingDate) = $year AND MONTH(bookingDate) = $month
                    GROUP BY movieName, MONTH(bookingDate);";
            $result = $conn->query($sql);
        
            if (!$result) {
                throw new Exception("Failed to execute query: " . $conn->error);
            }
        
            $array = array();
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $array[] = $row;
                }
            }else{
                $array = [];
            }
        
            return $array;
        } catch (Exception $e) {
            // Handle the exception here
            //echo "Error: " . $e->getMessage();
            return array();
        }
        

    }
    //Function to generate weekly report
    public function generateWeeklyReport($startDate,$endDate){
        global $conn;
        $conn -> select_db('CSIT314_Test');

        try {
            // SQL query to retrieve movieName, totalTickets, and totalAmount for bookings within a specific date range
            $sql = "SELECT movieName, SUM(numOfTicket) AS totalTickets, SUM(total_amnt) AS totalAmount
            FROM booking
            WHERE bookingDate BETWEEN '$startDate' AND '$endDate'
            GROUP BY movieName;";
            $result = $conn->query($sql);
        
            if (!$result) {
                throw new Exception("Failed to execute query: " . $conn->error);
            }
        
            $array = array();
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $array[] = $row;
                }
            }else{
                $array = [];
            }
        
            return $array;
        } catch (Exception $e) {
            // Handle the exception here
            //echo "Error: " . $e->getMessage();
            return array();
        }
        
    }
    //Function to retrieve room details
    public function getRoomDetail($searchInput,$searchBy){
        global $conn;
        $conn -> select_db('CSIT314_Test');

        // Construct SQL query to retrieve room details based on search input and search by criteria
        $sql = "SELECT * FROM `cinemaRoom` WHERE `$searchBy` LIKE '%$searchInput%';";

        try {
            $result = $conn->query($sql);

            if (!$result) {
                throw new Exception("Query execution failed: " . $conn->error);
            }

            $array = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $array[] = $row;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $array = array();
        }

        return $array;

    }
    //Function to search movie
    public function searchMovie($searchInput){
        global $conn;
        $conn->select_db('CSIT314_Test');

        // Construct SQL query to search for movies based on the provided search input
        $sql = "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status, r.roomName, a.timing1, a.timing2, a.timing3, a.timing4
                FROM cinemaMovie m
                LEFT JOIN cinemaAllocation a ON a.movieID = m.movieID
                LEFT JOIN cinemaRoom r ON r.roomID = a.roomID
                WHERE m.movieName LIKE '%$searchInput%';";
        
        try {
            $result = $conn->query($sql);
            
            if (!$result) {
                throw new Exception("Query execution failed: " . $conn->error);
            }
            
            $array = array();
            
            while ($row = mysqli_fetch_assoc($result)) {
                $array[] = $row;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $array = array();
        }
        
        return $array;
        
    }
    //Function to search food
    public function searchFood($searchInput){
        global $conn;
        $conn->select_db('CSIT314_Test');

        // Construct SQL query to search for food and drink items based on the provided search input
        $sql = "SELECT * FROM cinemaFoodAndDrink
                WHERE foodName LIKE '%$searchInput%';";
        
        try {
            $result = $conn->query($sql);
            
            if (!$result) {
                throw new Exception("Query execution failed: " . $conn->error);
            }
            
            $array = array();
            
            while ($row = mysqli_fetch_assoc($result)) {
                $array[] = $row;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $array = array();
        }
        
        return $array;
    }

}


?>