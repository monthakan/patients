<?php
     $request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
    //  $id = $request['patients_id']; //using it to get  the record
     $sample = $request['sample'];
     $title = $request['title'];
     $first_name = $request['first_name'];
     $surname = $request['surname'];
     $age = $request['age'];
     $ocdr = $request['ocdr'];
     $mmse = $request['mmse'];
    //  $blood_collection = DateTime::createFromFormat('d. m. Y', $request['blood_collection']);
     $blood_collection = new DateTime ($request['blood_collection']);
     $report_date = new DateTime($request['report_date']);
     $source = $request['source'];
     $tel = $request['tel'];
     $teltwo = $request['teltwo'];
     $lineid = $request['lineid'];
     $bloodformattedDate = $blood_collection->format("Y-m-d");
     $reportformattedDate = $report_date->format("Y-m-d");
   
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

      $sql = "INSERT INTO patients ( sample, title, first_name, surname, age, ocdr, mmse, blood_collection, report_date, source, tel, teltwo, lineid)
      VALUES ('".$sample."', '".$title."', '".$first_name."', '".$surname."', '".$age."','".$ocdr."','".$mmse."' ,'".$bloodformattedDate."', '".$reportformattedDate."','".$source."','".$tel."','".$teltwo."' ,'".$lineid."')";
    
      // Process the query so that we will save the date of birth
      if ($mysqli->query($sql)) {
        echo "บันทึกข้อมูลสำเร็จ";
      } else {
        return "Error: " . $sql . "<br>" . $mysqli->error;
      }
    
      // Close the connection after using it
      $mysqli->close();
?>