<?php 
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "attendancemsystem";
    $conn = new mysqli($host, $user, $password, $database);

    if ($conn -> connect_error){
        echo "Failed to connect to database $database ";
    };
?>