<?php
$conn = new mysqli('localhost','root', '');

class booking_model{
    // Function to get showing movies from the database
    public function getShowingMovie(){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            // SQL query to retrieve showing movies
            $sql =  "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status,
                        a.timing1, a.timing2, a.timing3, a.timing4
                        FROM cinemaMovie m
                        JOIN cinemaAllocation a ON m.movieID = a.movieID
                        WHERE m.relDate <= CURDATE() AND m.status = 'active';";
         
            $result = $conn->query($sql);
        
            $array = [];
        
            // check if the query was successful
            if(!$result){
                $array = [];
            }else{
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result) ) {
                    $array[] = $row;
                }
            }
          
        } catch (Exception $e) {
            // if the table doesn't exist or there's another error, return an empty array
            $array = [];
        }
        
        return $array;
    }
    
    // Function to get movie details for a specific booking ID and phone
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
    
    // Function to create a booking
    public function createBooking($phone,$movieID,$roomID,$movieName,$roomName, $time, $numOfTicket, $seats, $noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket, $bookingDate, $total_amnt, $loyaltypoints){
        global $conn;
        $conn->select_db("CSIT314_Test");
        
        // SQL query to create the booking table if it doesn't exist
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
             
            echo '<script>alert("Booking success")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }
        
    }
    
    // Function to get taken seats for a movie, show timing, and date
    public function takenSeats($movie,$showTiming,$date,$bookedID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        try {
            if ($bookedID == 0) {
                // Query to retrieve seats for a specific movie, show timing, and date when bookedID is 0
                $sql = "SELECT seats FROM `booking` WHERE movieID = '$movie' && showTiming = '$showTiming' && bookingDate = '$date';";
            } else {
                // Query to retrieve seats for a specific movie, show timing, and date excluding a particular booking ID
                $sql = "SELECT bookingID,seats FROM `booking` WHERE movieID = '$movie' && showTiming = '$showTiming' && bookingDate = '$date' && bookingID != $bookedID;";
            }

            $result = $conn->query($sql);
            if ($result == false) {
                $array = [];
            } else {
                $array = array();
                // fetch the result row as an associative array
                while ($row = mysqli_fetch_assoc($result)) {
                    $array[] = $row['seats'];
                }
            }
        } catch (Exception $e) {
            // echo "Error: " . $e->getMessage();
            $array = [];
        }

        // Check if $result is not set or false, set $array to an empty array
        if (!isset($result) || !$result) {
            $array = [];
        }

        if (count($array) > 0) {
            $merged_array = array();
            foreach ($array as $seats) {
                $seats_array = explode(',', $seats);
                
                $seats_array = array_map('trim', $seats_array); // trim each string in $seats_array
               
                $merged_array = array_merge($merged_array, $seats_array);
               
            }

            $taken_seats = array();
            foreach ($merged_array as $seat) {
                $row = substr($seat, 0, 1);
                $column = substr($seat, 1);
                if (strlen($seat) > 2) {
                    $row .= trim(substr($seat, 1, 1));
                    $column = substr($seat, 2);
                }
                $taken_seats[] = array('row' => $row, 'column' => $column);
            }
        } else {
            $taken_seats = [];
        }

        return $taken_seats;
    }
    //Function to retrieve booking details
    public function getBookingDetail($phone){
        global $conn;
        $conn->select_db("CSIT314_Test");
    
        try {
            // Query to retrieve booking details for a specific phone number
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
            // If the customerReview table doesn't exist, fallback to a simple SELECT query
            $sql = "SELECT * FROM booking WHERE phone = '$phone' AND `bookingDate` < CURDATE();";
            $result = $conn->query($sql);
            if (!$result) {
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
    //Function to redeem loyalty points
    public function redeemPoint($points,$phone){
        global $conn;
        $conn->select_db("CSIT314_Test");
    
        // Update the loyalty points for a specific customer
        $escapedPhone = mysqli_real_escape_string($conn, $phone);
        $sql = "UPDATE `customer` SET loyalty_point = '$points' WHERE phone = '$escapedPhone';";
        
        try { 
            mysqli_query($conn, $sql); 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error updating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }    
    }
    //Function to retrieve food and drinks data
    public function getFoodAndDrink(){
        global $conn;
        $conn->select_db("CSIT314_Test");
    
        try {
            // Retrieve active food and drink items with stock available
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
            $array = [];
        }
        
        return $array;
    }
    //Function to retrieve food ordered
    public function orderFood($phone,$date,$price,$orderedFood){
        global $conn;
        $conn->select_db("CSIT314_Test");
        
        // Create the fnbOrder table if it doesn't exist
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
            // Insert the food order details without a phone number
            $sql2 = "INSERT INTO `fnbOrder` (`bookingID`,`orderDate`, `totalPrice`)
            VALUES ((SELECT MAX(bookingID) FROM booking), '$date', '$price');";
    
        }else{
            // Insert the food order details with a phone number
            $sql2 = "INSERT INTO `fnbOrder` (`bookingID`, `phone`,`orderDate`, `totalPrice`)
            VALUES ((SELECT MAX(bookingID) FROM booking), '$phone', '$date', '$price');";
        }
        
        try {
            mysqli_query($conn, $sql2); 
            foreach($orderedFood as $foodID => $quantity){
                if($quantity > 0){
                    $this->orderItem($foodID,$quantity);
                }
            } 
            echo '<script>alert("Order successful")</script>'; 
            return true; 
        }
        catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }
    }
    //Function to see item ordered
    public function orderItem($foodID,$quantity){
        global $conn;
        $conn->select_db("CSIT314_Test");
        
        // Create the orderItem table if it doesn't exist
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
    //Function to earn points once booking is made
    public function gainPoints($loyaltypoints,$phone){
        global $conn;
        $conn->select_db('CSIT314_Test');
    
        // Update the loyalty points for a specific customer
        $sql = "UPDATE `customer` SET loyalty_point = loyalty_point + $loyaltypoints WHERE phone = $phone;";
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
    //Function to search movie
    public function searchMovie($searchInput){
        global $conn;
        $conn->select_db("CSIT314_Test");
    
        try {
            // Search for movies based on input keyword
            $sql =  "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status,
                        a.timing1, a.timing2, a.timing3, a.timing4
                        FROM cinemaMovie m
                        JOIN cinemaAllocation a ON m.movieID = a.movieID
                        WHERE m.relDate < CURDATE() AND m.status = 'active' AND m.movieName LIKE '%$searchInput%' ;";
         
            $result = $conn->query($sql);
        
            $array = [];
            // fetch the result row as an associative array
            while ($row = mysqli_fetch_assoc($result) ) {
                $array[] = $row;
            }
        } catch (Exception $e) {
            // if the table doesn't exist or there's another error, return an empty array
            $array = [];
        }
        
        return $array;
    }
    //Function to retrieve bookingID
    public function getBookingByID($bookedID){
        global $conn;
        $conn->select_db("CSIT314_Test");
    
        try {
            // Retrieve booking details based on the booking ID
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
            $array = [];
        }
        return $array;
    }
    //Function to retrieve selected seat by ID
    public function getSelectedSeatByID($bookedID){
        global $conn;
        $conn->select_db("CSIT314_Test");
        try {
    
            // Retrieve selected seats based on the booking ID
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
            $selectedSeat = [];
        }
        
        if (!isset($result) || !$result) {
            $selectedSeat = [];
        }
        
        return $selectedSeat;
    }
    //Function to update bookings that are already made
    public function updateBooking($bookedID,$numOfTicket,$seats,$noOfAdultTicket,$noOfChildTicket, $noOfSeniorTicket, $noOfStudentTicket,$total_amnt, $loyaltypoints){
        global $conn;
        $conn->select_db("CSIT314_Test");
        try {
            // Update booking details based on the booking ID
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
            // echo "Error: " . $e->getMessage();
            return false;
        }
        
    }
    //Function to retrieve booking details from customer phone number
    public function getBookings($phone){
        global $conn;
        $conn->select_db("CSIT314_Test");
    
        try {
            // Retrieve bookings based on the phone number
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
            // echo "Error: " . $e->getMessage();
            $array = [];
        }
        return $array;
    }
    //Function to retrieve food ordered
    public function getFoodOrder($phone){
        global $conn;
        $conn->select_db("CSIT314_Test");
    
        try {
            // Retrieve food orders based on the phone number
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
            // echo "Error: " . $e->getMessage();
            $array = [];
        }
        return $array;
    }
    //Function to retrieve food and drinks by ID
    public function getFoodAndDrinkByID($orderID){
        global $conn;
        $conn->select_db("CSIT314_Test");
    
        try {
            
            // Retrieve food and drink items based on the order ID
            $sql = "SELECT * FROM `orderItem` WHERE orderID = $orderID;";
            
            
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
            // echo "Error: " . $e->getMessage();
            $array = [];
        }
        return $array;
    }
    //Function to update food ordered by customer
    public function updateOrderFood($orderID,$price,$orderedFood){
        global $conn;
        $conn->select_db("CSIT314_Test");
        try {
            // Update total price of the food order based on the order ID
            $sql = "UPDATE fnbOrder SET 
                        totalPrice = $price
                    WHERE orderID = $orderID;";
            
            $result = $conn->query($sql);
        
            if ($result) {
                foreach($orderedFood as $foodID => $quantity){
                    if($quantity > 0){
                        if($this->updateOrderItem($orderID,$foodID,$quantity)==false){
                            continue;
                        }
                    }
                } 
                return true;
            } else {
                // Update failed
                return false;
            }
        } catch (Exception $e) {
            // echo "Error: " . $e->getMessage();
            return false;
        }
    }
    //Function to update item ordered
    public function updateOrderItem($orderID,$foodID,$quantity){
        global $conn;
        $conn->select_db("CSIT314_Test");
        try {
            // Update quantity of a food item in the order based on the order ID and food ID
            $sql = "UPDATE orderItem SET 
                        quantity = $quantity
                    WHERE orderID = $orderID && foodID = $foodID;";
            
            $result = $conn->query($sql);
        
            if ($result) {
                // Update successful
                return true;
            } else {
                // Update failed
                return false;
            }
        } catch (Exception $e) {
            // echo "Error: " . $e->getMessage();
            return false;
        }
    } 
    //FUnction to preview booking made
    public function getBookingPreview() {
        global $conn;
        $conn->select_db("CSIT314_Test");
        try {
            // Query to retrieve the booking details and final price for the latest booking with associated fnbOrder
            $query = "SELECT fnbOrder.*, booking.*, (fnbOrder.totalPrice + booking.total_amnt) AS finalPrice
                      FROM fnbOrder
                      JOIN booking ON fnbOrder.bookingID = booking.bookingID
                      WHERE booking.bookingID = (
                        SELECT MAX(bookingID)
                        FROM booking
                      )";
            
            $result = $conn->query($query);
            
            if ($result && $result->num_rows > 0) {
                $data = array();
                
                while ($row = $result->fetch_assoc()) {
                    $data = $row;
                }
                
                return $data;
            } else {
                return array(); // Return an empty array if no rows are found
            }
        } catch (Exception $e) {
            // Handle any exceptions that occur during the query execution
            echo "Error: " . $e->getMessage();
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

