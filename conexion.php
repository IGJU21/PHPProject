<?php

$servername = "localhost";
$database = "clientes2";
$username = "root";
$password = "";

//Create connection 
$conn = mysqli_connect($servername,$username,$password,$database);
//Check connection
if(!$conn){
    die("Connection failed: ".mysql_connect_error());
}