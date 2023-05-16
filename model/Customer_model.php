<?php
$conn = new mysqli('localhost','root', '');
require('user_model.php');
class customer_model extends user_model{
    public function getShowingMovie(){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            $sql =  "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status,
                        a.timing1, a.timing2, a.timing3, a.timing4
                        FROM cinemaMovie m
                        JOIN cinemaAllocation a ON m.movieID = a.movieID
                        WHERE m.relDate < CURDATE() AND m.status = 'active';";
         
            $result = $conn->query($sql);
        
            // fetch the result row as an associative array
            $array = [];
            while ($row = mysqli_fetch_assoc($result) ) {
                $array[] = $row;
            }
        } catch (Exception $e) {
            // if the table doesn't exist or there's another error, return an empty array
            echo "Error: " . $e->getMessage();
            $array = [];
        }
        
        return $array;
        
    }
    public function getMovieDetail($bookingID,$phone){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            //$sql = "SELECT * FROM `cinemaMovie` ";
            $sql =  "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status, r.roomName, r.roomID,
                    r.totalRow,r.totalColumn,a.timing1, a.timing2, a.timing3, a.timing4
                    FROM cinemaMovie m
                    LEFT JOIN cinemaAllocation a ON a.movieID = m.movieID
                    LEFT JOIN cinemaRoom r ON r.roomID = a.roomID
                    WHERE m.movieID = '$bookingID';";
        
            $sql2 = "SELECT `seat_row`,`seat_column`,`loyalty_point` FROM `customer` WHERE `phone`= $phone;";
        
            $result = $conn->query($sql);
            $result2 = $conn->query($sql2);
        
            $array = [];
        
            // check if the query was successful
            if ($result) {
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result) ) {
                    $array = $row;
                }
            }
        
            if ($result2) {
                // fetch the result row as an associative array
                while ($row2 = mysqli_fetch_assoc($result2) ) {
                    $array['seat_row'] = $row2['seat_row'];
                    $array['seat_column'] = $row2['seat_column'];
                    $array['loyalty_point']= $row2['loyalty_point'];
                }
            }
        
            return $array;
        
        } catch (Exception $e) {
            // handle the exception here
            return [];
        }
        
    }
    public function createBooking($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTiket, $seats, $noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints){
        global $conn;
        $conn->select_db("CSIT314_Test");
        $sql = "CREATE TABLE IF NOT EXISTS booking (
            bookingID INT PRIMARY KEY AUTO_INCREMENT,
            phone INT,
            movieID int(11) UNSIGNED,
            roomID INT(6) UNSIGNED,
            roomName varchar(225) NOT NULL,
            movieName VARCHAR(255),
            showTiming VARCHAR(255),
            numOfTicket INT,
            seats VARCHAR(255),
            noOfChildTicket INT,
            noOfSeniorTicket INT,
            noOfStudentTicket INT,
            bookingDate DATE,
            total_amnt DECIMAL(10, 2),
            loyaltypoints DECIMAL(10, 2),
            FOREIGN KEY (phone) REFERENCES customer(phone),
            FOREIGN KEY (movieID) REFERENCES cinemaMovie(movieID),
            FOREIGN KEY (roomID) REFERENCES cinemaRoom(roomID)
        );";
        if ($conn->query($sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        

        $sql2 = "INSERT INTO booking (phone,movieID, roomID,roomName, movieName, showTiming, numOfTicket, seats, noOfChildTicket, noOfSeniorTicket, noOfStudentTicket, bookingDate, total_amnt, loyaltypoints)
        VALUES ('$phone','$movieID', '$roomID', '$roomName', '$movieName', '$time', '$numOfTiket', '$seats', '$noOfChildTicket', '$noOfSeniorTicket', '$noOfStudentTicket', '$bookingDate', '$total_amnt', '$loyaltypoints');";

        
        
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
    public function updateSeat($phone,$columnSeat,$rowSeat){
        global $conn;
        $conn->select_db("CSIT314_Test");
        $sql = "UPDATE customer SET seat_row = '$rowSeat', seat_column = '$columnSeat' WHERE phone = '$phone';";
        if ($conn->query($sql) === TRUE) {
            echo "Table updated successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
    public function takenSeats($movieID,$showTiming,$date){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            $sql = "SELECT seats FROM `booking` WHERE movieID = '$movieID' && showTiming = '$showTiming' && bookingDate = '$date';";
            $result = $conn->query($sql);
            
            $array = array();
            // fetch the result row as an associative array
            while ($row = mysqli_fetch_assoc($result) ) {
                $array[] = $row ['seats'];
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $array = [];
        }
        
        return $array;
        
    }
    public function getBookingDetail($phone){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            $sql = "SELECT b.* 
                    FROM `booking` AS b 
                    LEFT JOIN `customerReview` AS cr 
                    ON b.bookingID = cr.bookingID 
                    WHERE b.phone = '$phone' AND b.`bookingDate` < CURDATE() AND cr.reviewID IS NULL;";
            
            $result = $conn->query($sql);
            $array = array();
            if (!$result) {
                throw new Exception("Query failed: " . $conn->error);
            } else {
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result)) {
                    $array[] = $row;
                }
            }
            return $array;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            // fallback to a simple SELECT query if customerReview table doesn't exist
            $sql = "SELECT * FROM booking WHERE phone = '$phone' AND `bookingDate` < CURDATE();";
            $result = $conn->query($sql);
            $array = array();
            if (!$result) {
                echo "Error: " . $conn->error;
            } else {
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result)) {
                    $array[] = $row;
                }
            }
            return $array;
        }
        
    }
    public function redeemPoint($newLoyaltyPoints,$phone){
        global $conn;
        $conn->select_db("CSIT314_Test");

        $sql = "UPDATE `customer` SET loyalty_point = $newLoyaltyPoints WHERE phone = $phone;";
        
        try { 
            mysqli_query($conn, $sql); 
            echo '<script>alert("good to go")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }
        
    }
    public function getFoodAndDrink(){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            $sql = "SELECT * FROM `cinemaFoodAndDrink` WHERE stock > 0 && status = 'active';";
            $result = $conn->query($sql);
            $array = array();
            if ($result) {
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result)) {
                    $array[] = $row;
                }
            } else {
                $array = [];
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $array = [];
        }
        
        return $array;
        
    }
    public function orderFood($phone,$date,$price){
        global $conn;
        $conn->select_db("CSIT314_Test");
        $sql = "CREATE TABLE IF NOT EXISTS fnbOrder (
            orderID INT AUTO_INCREMENT PRIMARY KEY,
            bookingID INT NOT NULL,
            phone INT NOT NULL,
            orderDate DATE NOT NULL,
            totalPrice DECIMAL(10,2) NOT NULL DEFAULT 0,
            FOREIGN KEY (bookingID) REFERENCES booking(bookingID),
            FOREIGN KEY (phone) REFERENCES customer(phone)
            );";
        if ($conn->query($sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
        
        

        $sql2 = "INSERT INTO `fnbOrder` (`bookingID`, `phone`,`orderDate`, `totalPrice`)
        VALUES ((SELECT MAX(bookingID) FROM booking), '$phone', '$date', '$price');";
       

        // $sql3 = "UPDATE `customer` SET loyalty_point = loyalty_point + $loyaltypoints WHERE phone = $phone;";
        
        try {
            mysqli_query($conn, $sql2); 
            //mysqli_query($conn, $sql3); 
            echo '<script>alert("good to go")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }
    }
    public function orderItem($foodID,$quantity){
        global $conn;
        $conn->select_db("CSIT314_Test");
        $sql = "CREATE TABLE IF NOT EXISTS orderItem (
            id INT AUTO_INCREMENT PRIMARY KEY,
            foodID INT UNSIGNED,
            orderID INT NOT NULL,
            quantity INT NOT NULL,
            FOREIGN KEY (orderID) REFERENCES fnbOrder(orderID),
            FOREIGN KEY (foodID) REFERENCES cinemaFoodAndDrink(foodID) 
            );";
        if ($conn->query($sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
        $sql2 = "INSERT INTO `orderItem` (`foodID`, `orderID`, `quantity`)
        VALUES ( '$foodID', (SELECT MAX(orderID) FROM fnbOrder), '$quantity');";

        // $sql3 = "UPDATE `customer` SET loyalty_point = loyalty_point + $loyaltypoints WHERE phone = $phone;";
        
        try {
            mysqli_query($conn, $sql2); 
            //mysqli_query($conn, $sql3); 
            echo '<script>alert("good to go")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }

    }

    public function addReview($bookingID, $roomID,$movieID,$movieName,$showTiming,$rating,$review){
        global $conn;
        $conn->select_db("CSIT314_Test");
        $sql = "CREATE TABLE IF NOT EXISTS customerReview (
            reviewID INT AUTO_INCREMENT PRIMARY KEY,
            bookingID INT,
            roomID INT UNSIGNED NOT NULL,
            movieID INT UNSIGNED NOT NULL,
            movieName VARCHAR(50),
            showTiming VARCHAR(50),
            rating INT NOT NULL,
            review VARCHAR(255),
            FOREIGN KEY (bookingID) REFERENCES booking(bookingID),
            FOREIGN KEY (roomID) REFERENCES cinemaRoom(roomID),
            FOREIGN KEY (movieID) REFERENCES cinemaMovie(movieID),
            UNIQUE (bookingID)
        );";
        if ($conn->query($sql) === TRUE) {
            echo "Table created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
        $sql2 = "INSERT INTO customerReview (bookingID, roomID, movieID, movieName, showTiming, rating, review)
        VALUES ('$bookingID', '$roomID', '$movieID', '$movieName', '$showTiming', '$rating', '$review');";

        // $sql3 = "UPDATE `customer` SET loyalty_point = loyalty_point + $loyaltypoints WHERE phone = $phone;";
        
        try {
            mysqli_query($conn, $sql2); 
            //mysqli_query($conn, $sql3); 
            echo '<script>alert("good to go")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }

    }
    public function gainPoints($loyaltypoints,$phone){
        global $conn;
        $conn->select_db('CSIT314_Test');

        $sql = "UPDATE `customer` SET loyalty_point = loyalty_point + $loyaltypoints WHERE phone = $phone;";
        try {
            mysqli_query($conn, $sql); 
            //mysqli_query($conn, $sql3); 
            echo '<script>alert("good to go")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }
    }
}

//$con = new customer;
//$arr = $con -> getPhoneandPass();
// print_r($arr);
// $con->checkUser(87945631,'qwe');
//print($con->getAccount());
// $con->createTable();
?>

