<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "muzik_veritabani";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>