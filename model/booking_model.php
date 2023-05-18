<?php
$conn = new mysqli('localhost','root', '');

class booking_model{
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
        
            if ($result2 && $result2->num_rows > 0) {
                $row2 = mysqli_fetch_assoc($result2);
                $array['seat_row'] = $row2['seat_row'];
                $array['seat_column'] = $row2['seat_column'];
                $array['loyalty_point'] = $row2['loyalty_point'];
            } else {
                $array['seat_row'] = '';
                $array['seat_column'] = 0;
                $array['loyalty_point'] = 0;
            }
        
            return $array;
        
        } catch (Exception $e) {
            // handle the exception here
            return [];
        }
        
    }
    public function createBooking($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTicket, $seats, $noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints){
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
            noOfAdultTicket INT,
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

        if($phone == 0){
            $sql2 = "INSERT INTO booking (movieID, roomID,roomName, movieName, showTiming, numOfTicket, seats, noOfAdultTicket,noOfChildTicket, noOfSeniorTicket, noOfStudentTicket, bookingDate, total_amnt, loyaltypoints)
            VALUES ('$movieID', '$roomID', '$roomName', '$movieName', '$time', '$numOfTicket', '$seats', '$noOfAdultTicket','$noOfChildTicket', '$noOfSeniorTicket', '$noOfStudentTicket', '$bookingDate', '$total_amnt', '$loyaltypoints');";
        }else{
            $sql2 = "INSERT INTO booking (phone,movieID, roomID,roomName, movieName, showTiming, numOfTicket, seats, noOfAdultTicket,noOfChildTicket, noOfSeniorTicket, noOfStudentTicket, bookingDate, total_amnt, loyaltypoints)
            VALUES ('$phone','$movieID', '$roomID', '$roomName', '$movieName', '$time', '$numOfTicket', '$seats', '$noOfAdultTicket','$noOfChildTicket', '$noOfSeniorTicket', '$noOfStudentTicket', '$bookingDate', '$total_amnt', '$loyaltypoints');";
    
        }
        

        
        
        
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
    
    public function takenSeats($movieID,$showTiming,$date,$bookedID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            if($bookedID == 0){
                $sql = "SELECT seats FROM `booking` WHERE movieID = '$movieID' && showTiming = '$showTiming' && bookingDate = '$date';";
            }else{
                $sql = "SELECT bookingID,seats FROM `booking` WHERE movieID = '$movieID' && showTiming = '$showTiming' && bookingDate = '$date' && bookingID != $bookedID;";
            }
            
            $result = $conn->query($sql);
            if($result == false){
                $array = [];
            }else{
                $array = array();
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result)) {
                    $array[] = $row['seats'];
                }
            }
            
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $array = [];
        }
        
        if (!isset($result) || !$result) {
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
                $array = [];
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
            if (!$result) {
                echo "Error: " . $conn->error;
                return array(); // Return an empty array
            } else {
                $array = array();
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result)) {
                    $array[] = $row;
                }
                return $array;
            }
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
            phone INT,
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
        
        if($phone == 0){
            $sql2 = "INSERT INTO `fnbOrder` (`bookingID`,`orderDate`, `totalPrice`)
            VALUES ((SELECT MAX(bookingID) FROM booking), '$date', '$price');";
    
        }else{
            $sql2 = "INSERT INTO `fnbOrder` (`bookingID`, `phone`,`orderDate`, `totalPrice`)
            VALUES ((SELECT MAX(bookingID) FROM booking), '$phone', '$date', '$price');";
       

        }

        
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
    public function searchMovie($searchInput){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            $sql =  "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status,
                        a.timing1, a.timing2, a.timing3, a.timing4
                        FROM cinemaMovie m
                        JOIN cinemaAllocation a ON m.movieID = a.movieID
                        WHERE m.relDate < CURDATE() AND m.status = 'active' AND m.movieName LIKE '%$searchInput%' ;";
         
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
    public function getBookingByID($bookedID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            $sql = "SELECT b.*, cr.totalRow, cr.totalColumn
            FROM booking AS b
            JOIN cinemaRoom AS cr ON b.roomID = cr.roomID            
            WHERE b.bookingID = '$bookedID';";
            
            $result = $conn->query($sql);
            $array = array();
            if (!$result) {
                throw new Exception("Query failed: " . $conn->error);
                $array = [];
            } else {
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result)) {
                    $array = $row;
                }
            }
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $array = [];
        }
        return $array;
    }
    public function getSelectedSeatByID($bookedID){
        global $conn;
        $conn->select_db("CSIT314_Test");
        try {
    
            $sql = "SELECT seats FROM `booking` WHERE `bookingID` = $bookedID;";

            $result = $conn->query($sql);
            if($result == false){
                $array = [];
            }else{
                $array = array();
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result)) {
                    $array[] = $row['seats'];
                }
            }
            if(count($array)>0){ 
                $merged_array = array();
                foreach ($array as $seats) {
                    $seats_array = explode(',', $seats);
                    $seats_array = array_map('trim', $seats_array); // trim each string in $seats_array
                    $merged_array = array_merge($merged_array, $seats_array);
                }
            
                $selectedSeat = array();
                foreach ($merged_array as $seat) {
                    $row = substr($seat, 0, 1);
                    $column = substr($seat, 1);
                    if (strlen($seat) > 2) {
                        $row .= trim(substr($seat, 1, 1));
                        $column = substr($seat, 2);
                    }
                    $selectedSeat[] = array('row' => $row, 'column' => $column);
                }
            }else{
                $selectedSeat=[];
            }
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $selectedSeat = [];
        }
        
        if (!isset($result) || !$result) {
            $selectedSeat = [];
        }
        
        return $selectedSeat;
    }
    public function updateBooking($bookedID,$numOfTicket,$seats,$noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket,$total_amnt, $loyaltypoints){
        global $conn;
        $conn->select_db("CSIT314_Test");
        try {
            // Your database connection code
            
            $sql = "UPDATE booking SET 
                        numOfTicket = $numOfTicket,
                        seats = '$seats',
                        noOfAdultTicket = $noOfAdultTicket,
                        noOfChildTicket = $noOfChildTicket,
                        noOfSeniorTicket = $noOfSeniorTicket,
                        noOfStudentTicket = $noOfStudentTicket,
                        total_amnt = $total_amnt,
                        loyaltypoints = $loyaltypoints
                    WHERE bookingID = $bookedID";
            
            $result = $conn->query($sql);
        
            if ($result) {
                // Update successful
                return true;
            } else {
                // Update failed
                return false;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
        
    }
    public function getBookings($phone){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            $sql = "SELECT *
            FROM booking
            WHERE booking.phone = $phone;";
            
            $result = $conn->query($sql);
            $array = array();
            if (!$result) {
                throw new Exception("Query failed: " . $conn->error);
                $array = [];
            } else {
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result)) {
                    $array[] = $row;
                }
            }
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $array = [];
        }
        return $array;
    }
    public function getFoodOrder($phone){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            $sql = "SELECT fnbOrder.orderID, fnbOrder.bookingID, fnbOrder.phone, fnbOrder.orderDate, fnbOrder.totalPrice,
            orderItem.id, orderItem.foodID, orderItem.quantity,
            cinemaFoodAndDrink.foodName
            FROM fnbOrder
            JOIN orderItem ON fnbOrder.orderID = orderItem.orderID
            JOIN cinemaFoodAndDrink ON orderItem.foodID = cinemaFoodAndDrink.foodID
            WHERE fnbOrder.phone = $phone;";
            
            $result = $conn->query($sql);
            $array = array();
            if (!$result) {
                throw new Exception("Query failed: " . $conn->error);
                $array = [];
            } else {
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result)) {
                    $array[] = $row;
                }
            }
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $array = [];
        }
        return $array;
    }
}

//$con = new customer;
//$arr = $con -> getPhoneandPass();
// print_r($arr);
// $con->checkUser(87945631,'qwe');
//print($con->getAccount());
// $con->createTable();
?>

