<?php
$host = "sql7.freesqldatabase.com"; // Hostname
$name = "sql7757762";           // Database name
$password = "wdH4euAp4m";           // Database password
$database = "sql7757762";           // Database name
$port = 3306;                       // Port number

// Create connection and catch errors
try {
    $handle = new PDO("mysql:host=$host;port=$port;dbname=$database", $name, $password);
    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed");
}
?>