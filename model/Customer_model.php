<?php
$conn = new mysqli('localhost','root', '');
require('user_model.php');
class customer_model extends user_model{
    public function getShowingMovie(){
        global $conn;
        $conn->select_db("CSIT314_Test");

        //$sql = "SELECT * FROM `cinemaMovie` ";
        $sql =  "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status
        FROM cinemaMovie m
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
    public function getMovieDetail($bookingID){
        global $conn;
        $conn->select_db("CSIT314_Test");

        //$sql = "SELECT * FROM `cinemaMovie` ";
        $sql =  "SELECT m.movieID, m.movieName, m.movieBanner, m.relDate, m.genre, m.duration, m.status, r.roomName, 
        r.totalRow,r.totalColumn,a.timing1, a.timing2, a.timing3, a.timing4
        FROM cinemaMovie m
        LEFT JOIN cinemaAllocation a ON a.movieID = m.movieID
        LEFT JOIN cinemaRoom r ON r.roomID = a.roomID
        WHERE m.movieID = '$bookingID';";
 
        $result = $conn->query($sql);

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
