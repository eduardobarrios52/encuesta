<?php
$servername = "localhost";
$username = "mimgcomm_admin";
$password = "Trajosa1320.*";
$dbname = "mimgcomm_expressmg";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

