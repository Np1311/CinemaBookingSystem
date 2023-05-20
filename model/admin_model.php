<?php
$conn = new mysqli('localhost','root', '');

require ('user_model.php');

class admin_model extends user_model{
    private $profile;

    public function _construct($profile){
        $this->profile = $profile;
    }

    // Function to create a table based on the profile
    public function createTable($profile){
        global $conn;
        $conn -> select_db("CSIT314_Test");

        // Check if the profile is 'customer'
        if ($profile == 'customer'){
            // Create customer table with specific columns
            $sql = "CREATE TABLE IF NOT EXISTS `customer` (
                `fname` varchar(255) NOT NULL,
                `lname` varchar(255) NOT NULL,
                `seat_row` CHAR(1) DEFAULT NULL,
                `seat_column` INT NOT NULL DEFAULT 0,
                `phone` INT NOT NULL DEFAULT 0,
                `email` VARCHAR(255) NOT NULL,
                `password` VARCHAR(255) NOT NULL,
                `dob` DATE NOT NULL,
                `loyalty_point` DECIMAL(10,2) NOT NULL DEFAULT 0,
                `status` VARCHAR(25) DEFAULT 'active',
                PRIMARY KEY(phone)
            );";
        }else{
            // Create a table with generic columns for other profiles
            $sql = "CREATE TABLE IF NOT EXISTS `$profile` (
                `fname` varchar(255) NOT NULL,
                `lname` varchar(255) NOT NULL,
                `phone` INT NOT NULL DEFAULT 0,
                `email` VARCHAR(255) NOT NULL,
                `password` VARCHAR(255) NOT NULL,
                `dob` DATE NOT NULL,
                `status` VARCHAR(25) DEFAULT 'active',
                PRIMARY KEY(phone)
            );";
        }

        // Execute the SQL query to create the table
        if ($conn->query($sql) === TRUE) {
            echo "Table customer created successfully";
            return true;
        } else {
            echo "Error creating table: " . $conn->error;
            return false;
        }
    }

    // Function to list all profiles in the database
    public function listedProfile(){
        global $conn;
        $array = array();
        $sql = "SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = 'CSIT314_Test';";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $array[]= $row['TABLE_NAME'];
        }
        return $array;
    }

    // Function to suspend an account in a specific profile
    public function suspendAccount($curProfile, $userID){
        global $conn;
        $conn->select_db('CSIT314_Test');
        $sql = "UPDATE `$curProfile` SET `status` = 'suspend' WHERE `phone` = '$userID';";
        try {
            mysqli_query($conn, $sql); 
            return true; 
        } catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }
    }

    // Function to suspend a profile
    public function suspendProfile($suspendProfile){
        global $conn;
        $conn->select_db('CSIT314_Test');
        $sql = "UPDATE $suspendProfile SET `status` = 'suspend';";
        try {
            mysqli_query($conn, $sql); 
            return true; 
        } catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }
    }

    // Function to activate a profile
    public function activateProfile($profile){
        global $conn;
        $conn->select_db('CSIT314_Test');
        $sql = "UPDATE $profile SET `status` = 'active';";
        try {
            mysqli_query($conn, $sql); 
            return true; 
        } catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }
    }

    // Function to get account details based on a search query
    public function getAccountDetail($profile, $searchAccount, $searchBy){
        global $conn;
        $conn->select_db('CSIT314_Test');
        $sql = "SELECT * FROM $profile WHERE $searchBy LIKE '%$searchAccount%';";

        $result = $conn->query($sql);

        $array = array();
        if (!$result) {
            echo "Error: " . $conn->error;
            $array = [];
        } else {
            // fetch the result row as an associative array
            while ($row = mysqli_fetch_assoc($result) ) {
                $array[] = $row;
            }
        }

        return $array;
    } 

    // Function to update a profile name
    public function updateProfile($updateProfile, $updateValue){
        global $conn;
        $conn->select_db('CSIT314_Test');
        $sql = "ALTER TABLE $updateProfile RENAME TO $updateValue;";
        try {
            mysqli_query($conn, $sql); 
            return true; 
        } catch(mysqli_sql_exception $e) {
            die("Error creating user: " . mysqli_error($conn)); 
            echo '<script>alert("error updating user")</script>'; 
            return false;
        }
    }
}

// $adm = new admin();

// $adm -> updateProfile('admin','system_admin');
?>
