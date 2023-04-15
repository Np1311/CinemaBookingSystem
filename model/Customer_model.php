<?php
$conn = ;
class customer{
    public function createTable($tableName){
        global $conn;
        $conn -> select_db("CSIT314Try");
        $sql = "CREATE TABLE IF NOT EXISTS `customer` (
            `staff_id` varchar(5) NOT NULL,
            `id` int(11) NOT NULL DEFAULT 0
          );";
    
          if ($conn->query($sql) === TRUE) {
              echo "Table subject created successfully";
          } else {
              echo "Error creating table: " . $conn->error;
          }
    }
}
?>