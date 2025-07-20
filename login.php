<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Simple SQL query to match receptionist
    $sql = "SELECT * FROM receptionist WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $_SESSION['reception'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('❌ Invalid credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receptionist Login</title>
</head>
<body>
    <h2>Receptionist Login</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
