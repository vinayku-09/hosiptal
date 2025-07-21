<?php
session_start();
if(!isset($_SESSION['reception'])){
    header("location:login.php");
    exit();
}
include '../db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name =$_POST['name'];
    $specialization =$_POST['specialization'];
    $contact =$_POST['contact'];
    $sql = "INSERT INTO doctors(name, specialization, contact) VALUES ('$name', '$specialization', '$contact')";
    if($conn->query($sql)){
        echo "<script>alert('Doctor added successfully!');</script>";
    } else{
        echo "<script>alert('Error adding doctor: " . $conn->error . "');</script>";
    }
}

$doctors = $conn->query("SELECT * FROM doctors");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Doctors</title>
</head>
<body>
    <h2> DOCTOR MANAGEMENT</h2>
    <form method="POST" >
        <input type="text" name="name" placeholder="Doctor Name" required>
        <input type="text" name="specialization" placeholder="Specialization" required>
        <input type="text" name="contact" placeholder="Contact Number" required>
        <button type="submit">Add Doctor</button>
    </form>
    <hr>
    <h3>Existing Doctors</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Name</th>
            <th>Specialization</th>
            <th>Contact</th>
        </tr>
        <?php while($row = $doctors->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['specialization']; ?></td>
            <td><?php echo $row['contact']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>

</body>
</html>
