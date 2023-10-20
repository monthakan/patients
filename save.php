<?php
    $request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
   // $ID = $request['id']; //using it to get  the record
    $sample = $request['sample'];
    $title = $request['title'];
    $first_name = $request['first_name'];
    $surname = $request['surname'];
    $age = $request['age'];
    $ocdr = $request['ocdr'];
    $mmse = $request['mmse'];
    $blood_collection = new DateTime($request['blood_collection']);
    $report_date = new DateTime($request['report_date']);
    $source = $request['source'];
    $tel = $request['tel'];
    $teltwo = $request['teltwo'];
    $lineid = $request['lineid'];
    $bloodformattedDate = $blood_collection->format('Y-m-d');
    $reportformattedDate = $report_date->format('Y-m-d');
    // $creation_date = $request['creation_date']; 
   
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

      $sql = "INSERT INTO patients ( title, sample, first_name, surname, age, ocdr, mmse, blood_collection, report_date, source, tel, teltwo, lineid)
      VALUES ('".$title."', '".$sample."', '".$first_name."', '".$surname."', '".$age."','".$ocdr."','".$mmse."' ,'".$bloodformattedDate."', '".$reportformattedDate."','".$source."','".$tel."','".$teltwo."' ,'".$lineid."')";
    
      // Process the query so that we will save the date of birth
      if ($mysqli->query($sql)) {
        echo "Patient has been created.";
      } else {
        return "Error: " . $sql . "<br>" . $mysqli->error;
      }
    
      // Close the connection after using it
      $mysqli->close();

?>