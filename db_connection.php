<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cvdb';

// Create a connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$connection) {
    die('Database connection error: ' . mysqli_connect_error());
}
?>
