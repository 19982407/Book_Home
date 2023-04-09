<?php
$servername = "localhost";
$username = "root";
$password = "";
$DB_name = "borrowing_books";

// Create connection
$conn = new mysqli($servername, $username, $password,$DB_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>