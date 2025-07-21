<?php
session_start();
if (!isset($_SESSION['reception'])) {
    header("location:login.php");
    exit();
}
include '../db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_name = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];

    $sql= "INSERT INTO appointments(patient_id, doctor_id, date) VALUES ('$patient_name', '$doctor_id', '$date')";

    if($conn->query($sql)){
        echo "<script>alert('Appointment booked successfully!');</script>";
    } else{
        echo "<script>alert('Error booking appointment: " . $conn->error . "');</script>";
    }
}

$patients = $conn->query("SELECT * FROM patients");
$doctors = $conn->query("SELECT * FROM doctors");
$appointments =$conn->query("SELECT a.id,p.name AS patient,d.name AS doctor,a.date FROM appointments a JOIN patients p ON a.patient_id = p.id JOIN doctors d ON a.doctor_id = d.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
</head>
<body>
    <h2> manage appointmnets</h2>
    <form method="POST">
        <label>Patient:</label>
        <select name="patient_id" required>
            <?php while ($p = $patients->fetch_assoc()): ?>
            <option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <label>Doctor:</label>
        <select name="doctor_id" required>
            <?php while ($d = $doctors->fetch_assoc()): ?>
            <option value="<?php echo $d['id']; ?>"><?php echo $d['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <label>Date:</label>
        <input type="date" name="date" required>
        <button type="submit">Book Appointment</button>
    </form>
    <hr>
    <h3>All Appointments</h3>
    <table border="1" cellpadding="10">
       <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Date</th>
        </tr>
        <?php while ($a = $appointments->fetch_assoc()): ?>
        <tr>
            <td><?php echo $a['id']; ?></td>
            <td><?php echo $a['patient']; ?></td>
            <td><?php echo $a['doctor']; ?></td>
            <td><?php echo $a['date']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>