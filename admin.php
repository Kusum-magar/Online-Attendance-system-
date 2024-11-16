<?php
session_start();
require '../db.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Welcome, Admin</h1>
    <nav>
        <a href="manage_students.php">Manage Students</a>
        <a href="manage_attendance.php">Manage Attendance</a>
        <a href="../logout.php">Logout</a>
    </nav>
</body>
</html>
