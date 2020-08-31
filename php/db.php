<?php

    $host = "localhost";
    $name = "root";
    $pass = "";
    $db = "recycle";
    $con = new mysqli($host,$name,$pass,$db);
    // check databases error
    if($con->connect_error){
        die("connection failes" .$con->connect_error);
    }



?>