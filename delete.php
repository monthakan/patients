<?php
    $request = $_REQUEST; //a PHP Super Global variable which used to collect data after submitting it from the form
    $id = $request['patients_id']; //using it to get  the record
   
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


      //set delete sql data
      $sql = "DELETE FROM patients WHERE id = '".$id."' ";

      //process the query
      if($mysqli->query($sql)){
        echo "delated";
      } else {
        echo "Error : ". $sql . "<br>" . $mysqli->error;
      }
      // Close the connection after using it
	    $mysqli->close();

?>