<?php
    $request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
    $id = $request['id']; //using it to get  the record
    $sample = $request['sample'];
    $title = $request['title'];
    $first_name = $request['first_name'];
    $surname = $request['surname'];
    $age = $request['age'];
    $ocdr = $request['ocdr'];
    $mmse = $request['mmse'];
    $blood_collection = new DateTime ($request['blood_collection']);
    $report_date = new DateTime($request['report_date']);
    $source = $request['source'];
    $tel = $request['tel'];
    $teltwo = $request['teltwo'];
    $lineid = $request['lineid'];
    $bloodformattedDate = $blood_collection->format('Y-m-d');
    $reportformattedDate = $report_date->format('Y-m-d');
    
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

    $sql = "UPDATE patients SET title ='".$title."', sample='".$sample."',surname='".$surname."', first_name='".$first_name."', age='".$age."',ocdr='".$ocdr."',mmse='".$mmse."', blood_collection='".$bloodformattedDate."', report_date='".$reportformattedDate."',source='".$source."',tel='".$tel."', teltwo='".$teltwo."',lineid='".$lineid."' WHERE id ='".$id."'";

    // Process the query so that we will save the date of birth
    if ($mysqli->query($sql)) {
      echo "Patients has been updated.";
    } else {
      echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close the connection after using it
    $mysqli->close();
?>