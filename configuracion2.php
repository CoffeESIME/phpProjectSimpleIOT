<?php
  $servername = "localhost:3306";
  $username = "root";
  $password = "";

//    $servername = "localhost:3307";
//    $username = "root";
//    $password = "12Telemetic12";
   try {
       $conn = new PDO("mysql:host=$servername;dbname=grdxf", $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
       }
   catch(PDOException $e)
       {
       echo "Connection failed: " . $e->getMessage();
       }
?>