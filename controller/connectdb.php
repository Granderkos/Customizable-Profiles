<?php
   //connects to database
   $conn = new mysqli('localhost','root','','Benchmark');
   
   if ($conn->connect_error) 
   {
      die("Error: Něco se pokazilo".$conn->connect_error);
   }
?>