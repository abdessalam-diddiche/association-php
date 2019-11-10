<?php
/*
$servername="localhost";
$username="root";
$pass="";
try{
    $db = new PDO("mysql:host=$servername;dbname=blog",$username,$pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

// Create connection
$conn  = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// $servername = "localhost";
// $username = "root";
// $password = "";

// // Create connection
// mysqli_connect($servername, $username, $password);
// mysql_select_db("blog")

?>