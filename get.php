<?php
    $request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
    $patientsID = $request['Patients_id']; //using it to get  the record
   
    // set
    $servername = "localhost" ; 
    $username = "root" ;
    $password = "root";
    $dbname = "apptest";

    $mysqli = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
      }

    // set insert sql data
    $sql = " SELECT * FROM Patients WHERE id = '".$PatientsID."'";

    //process the quary
    $results = $mysqli->query($sql);

    // Fetch Associative array
    $row = $results->fetch_assoc();

    //free result set
    $results->free_result();

    //close the connection
    $mysqli->close();

    echo json_encode($row);
?>