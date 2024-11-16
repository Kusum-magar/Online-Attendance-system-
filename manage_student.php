<?php
session_start();
require '../db.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Handle adding students
if (isset($_POST['add_student'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, 'student')");
    $stmt->execute(['username' => $username, 'password' => $password]);
}

// Fetch students
$students = $conn->query("SELECT * FROM users WHERE role = 'student'")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Manage Students</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Student Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="add_student">Add Student</button>
    </form>
    <h2>Students List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student['id'] ?></td>
                <td><?= $student['username'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php">Back to Dashboard</a>
</body>
</html>
