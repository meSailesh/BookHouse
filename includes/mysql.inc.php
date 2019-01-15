<?php
$host='localhost';
$user='root';
$paswd="";
$dbname='bookhouse_db';
$conn=new mysqli($host,$user,$paswd,$dbname) or die("Connection failed: " . $conn->connect_error);
?>
