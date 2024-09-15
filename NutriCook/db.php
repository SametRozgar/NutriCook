<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "malzemeler";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}
?>
