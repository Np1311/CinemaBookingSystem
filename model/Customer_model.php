<?php

require_once('user_model.php');
class customer_model extends user_model{
    public function updateSeat($phone,$columnSeat,$rowSeat){
        global $conn;
        $conn->select_db("CSIT314_Test");
        // SQL query to update the seat information of the customer
        $sql = "UPDATE customer SET seat_row = '$rowSeat', seat_column = '$columnSeat' WHERE phone = '$phone';";
        if ($conn->query($sql) === TRUE) {
            echo "Table updated successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
    
    //Function to add review
    public function addReview($bookingID, $roomID,$movieID,$movieName,$showTiming,$rating,$review){
        global $conn;
        $conn->select_db("CSIT314_Test");
        // SQL query to create the customerReview table
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
        // SQL query to insert the review into the customerReview table
        $sql2 = "INSERT INTO customerReview (bookingID, roomID, movieID, movieName, showTiming, rating, review)
        VALUES ('$bookingID', '$roomID', '$movieID', '$movieName', '$showTiming', '$rating', '$review');";

        // $sql3 = "UPDATE `customer` SET loyalty_point = loyalty_point + $loyaltypoints WHERE phone = $phone;";
        
        try {
            mysqli_query($conn, $sql2); 
            //mysqli_query($conn, $sql3); 
            echo '<script>alert("Review submited, Thank You for Your Review")</script>'; 
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

