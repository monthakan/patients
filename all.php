<?php
    $servername = "localhost" ; 
    $username = "root" ;
    $password = "";
    $dbname = "apptest";

    $mysqli = new mysqli($servername, $username , $password, $dbname);

    if($mysqli->connect_errno) {
        echo "Failed to connect to MySQL:" .$mysqli->connect_error;
        exit();
    }

    //insert sql
    $sql = "SELECT * FROM patients ";

    //process the query -> save data
    $results = $mysqli->query($sql);

    $row = $results->fetch_all(MYSQLI_ASSOC);
    $results->free_result();
    $mysqli->close();

    echo json_encode($row);









?>