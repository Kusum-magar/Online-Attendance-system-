<?php
session_start();
require '../db.php';

if ($_SESSION['role'] !== 'student') {
    header('Location: ../login.php');
    exit;
}

$student_id = $_SESSION['user_id'];
$attendance = $conn->query("SELECT * FROM attendance WHERE student_id = $student_id")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Your Attendance</h1>
    <table>
        <tr>
            <th>Date</th>
            <th>Status</th>
        </tr>
        <?php foreach ($attendance as $row): ?>
            <tr>
                <td><?= $row['date'] ?></td>
                <td><?= $row['status'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table
