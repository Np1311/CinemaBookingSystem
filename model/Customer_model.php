<?php
$conn = new mysqli('localhost','root', '');
require('user_model.php');
class customer_model extends user_model{
    public function getShowingMovie(){
        global $conn;
        $conn->select_db("CSIT314_Test");

        //$sql = "SELECT * FROM `cinemaMovie` ";
        $sql =  "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status,
                a.timing1, a.timing2, a.timing3, a.timing4
                FROM cinemaMovie m
                JOIN cinemaAllocation a ON m.movieID = a.movieID
                WHERE m.relDate < CURDATE() AND m.status = 'active';";
 
        $result = $conn->query($sql);

        // check if the query was successful
        if (!$result) {
        echo "Error: " . $conn->error;
            $array = [];
        }else{
            // fetch the result row as an associative array
            while ($row = mysqli_fetch_assoc($result) ) {
                $array[] = $row;
            }
        }

        return $array;
    }
    public function getMovieDetail($bookingID,$phone){
        global $conn;
        $conn->select_db("CSIT314_Test");

        //$sql = "SELECT * FROM `cinemaMovie` ";
        $sql =  "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status, r.roomName, r.roomID,
        r.totalRow,r.totalColumn,a.timing1, a.timing2, a.timing3, a.timing4
        FROM cinemaMovie m
        LEFT JOIN cinemaAllocation a ON a.movieID = m.movieID
        LEFT JOIN cinemaRoom r ON r.roomID = a.roomID
        WHERE m.movieID = '$bookingID';";

        $sql2 = "SELECT `seat_row`,`seat_column`FROM `customer` WHERE `phone`= $phone;";
 
        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);

        // check if the query was successful
        if (!$result) {
        echo "Error: " . $conn->error;
            $array = [];
        }else{
            // fetch the result row as an associative array
            while ($row = mysqli_fetch_assoc($result) ) {
                $array = $row;
            }
        }
        if (!$result2) {
        echo "Error: " . $conn->error;
           
        }else{
            // fetch the result row as an associative array
            while ($row2 = mysqli_fetch_assoc($result2) ) {
                $array['seat_row'] = $row2['seat_row'];
                $array['seat_column'] = $row2['seat_column'];
            }
        }

        return $array;
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

        $sql3 = "UPDATE `customer` SET loyalty_point = loyalty_point + $loyaltypoints WHERE phone = $phone;";
        
        try {
            mysqli_query($conn, $sql2); 
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

        $sql = "SELECT seats FROM `booking` WHERE movieID = '$movieID' && showTiming = '$showTiming' && bookingDate = '$date';";
        $result = $conn->query($sql);
        $merged_array = array();
        $array = array();
        if (!$result) {
        echo "Error: " . $conn->error;
            $array = [];
        }else{
            // fetch the result row as an associative array
            while ($row = mysqli_fetch_assoc($result) ) {
                $array[] = $row ['seats'];
            }
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
