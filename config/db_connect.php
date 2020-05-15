<?php
  $host = "localhost";
  $username = "";
  $pwd = "";
  $db = "";

  $conn = mysqli_connect($host, $username, $pwd, $db);

  if(!$conn){
    echo "error: " . my_sqli_connect_error();
  }

?>