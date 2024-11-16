<?php
session_start();
require '../db.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("INSERT INTO attendance (student_id, date, status) VALUES (:student_id, :date, :status)");
    $stmt->execute(['student_id' => $student_id, 'date' => $date, 'status' => $status]);
}

$students = $conn->query("SELECT * FROM users WHERE role = 'student'")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Attendance</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Manage Attendance</h1>
    <form method="POST">
        <select name="student_id" required>
            <option value="">Select Student</option>
            <?php foreach ($students as $student): ?>
                <option value="<?= $student['id'] ?>"><?= $student['username'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="date" name="date" required>
        <select name="status" required>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
        <button type="submit">Submit Attendance</button>
    </form>
    <a href="index.php">Back to Dashboard</a>
</body>
</html>
