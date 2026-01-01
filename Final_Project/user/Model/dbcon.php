<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "WT_Fall-25-26-";   //database name

$conn = new mysqli($host,$user,$pass,$dbname);
 
if($conn->connect_error)
{
    die("Connect lost". $conn->connect_error);        
}