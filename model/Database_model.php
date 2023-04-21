<?php
$conn = new mysqli('localhost','root', '');

class database {
    public function createDatabase($dbName){
        global $conn;
        $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
        try {
            mysqli_query($conn, $sql); 
            echo "Database created successfully"; }
        catch(mysqli_sql_exception $e) {
            die("Error creating database: " . mysqli_error($conn)); }
    }

   
}


$con = new database;
$con -> createDatabase("CSIT314_Test");
?>
git config --global user.email "csit314projectt@gmail.com"
git config --global user.name "wiltzy"