<?php
session_start();
if (!isset($_SESSION['reception'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reception Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['reception']; ?> 👋</h2>
    <ul>
        <li><a href="reception/rooms.php">🏨 Rooms</a></li>
        <li><a href="reception/doctors.php">👨‍⚕️ Doctors</a></li>
        <li><a href="reception/appointments.php">📅 Appointments</a></li>
        <li><a href="reception/bills.php">💰 Patient Bills</a></li>
        <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
</body>
</html>
