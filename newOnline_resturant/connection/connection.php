<?php

$serverName="localhost";
$userName="root";
$password="";
$dbName="online_resturant";

$quer =mysqli_connect($serverName,$userName,$password,$dbName);

if(!$quer){
    die("error : " .mysqli_connect_error());
}

?>