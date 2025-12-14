<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_resturant";

$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
  echo mysqli_connect_error();  
}
