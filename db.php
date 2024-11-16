<?php
$host = 'localhost';
$dbname = 'attendance_system';
$user = 'root'; // Your DB username
$pass = ''; // Your DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
