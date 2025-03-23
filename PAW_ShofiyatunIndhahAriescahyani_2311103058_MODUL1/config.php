<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "dbpembelianmobil";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Config gagal" . $conn->connect_error);
}
?>
