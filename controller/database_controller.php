<?php
require('../model/Database_model.php');

$con = new database_model;

class database_controller{
    public function setupDatabase(){
        global $con;
        $con -> createDatabase("CSIT314_Test");
        $con -> createFirstProfile();
        $con -> createFirstUser();
    }
    
}

?>