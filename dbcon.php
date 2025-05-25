<?php 

$host = "localhost";
$dbname = "rlg-store";
$username = "root";
$pass = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$pass);

if($conn == true)
{
    echo " ";
}
else
{
    echo "connection failed";
}

?>