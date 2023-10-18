<?php
    $request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
    $ID = $request['id']; //using it to get  the record
    $sample = $request['sample'];
    $title = $request['title'];
    $first_name = $request['first_name'];
    $surname = $request['surname'];
    $age = $request['age'];
    $ocdr = $request['ocdr'];
    $mmse = $request['mmse'];
    $blood_collection = $request['blood_collection'];
    $report_date = $request['report_date'];
    $source = $request['source'];
    $tel = $request['tel'];
    $teltwo = $request['teltwo'];
    $line = $request['line'];
    $record_date = $request['date_record'];
   
    // set
    $servername = "localhost" ; 
    $username = "root" ;
    $password = "";
    $dbname = "apptest";

    $mysqli = new mysqli($servername, $username, $password, $dbname);

      if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
      }

      $sql = "INSERT INTO patients ( sample, title, first_name, surname, age, ocdr, mmse, blood_collection, report_date, source, tel, teltwo, line, date_record)
      VALUES ('".$sample."', '".$title."', '".$first_name."', '".$surname."', '".$age."','".$ocdr."','".$mmse."' ,'".$blood_collection."', '".$report_date."','".$source."','".$tel."','".$teltwo."' ,'".$line."', '".$record_date."')";
    
      // Process the query so that we will save the date of birth
      if ($mysqli->query($sql)) {
        echo "Patient has been created.";
      } else {
        return "Error: " . $sql . "<br>" . $mysqli->error;
      }
    
      // Close the connection after using it
      $mysqli->close();

?>