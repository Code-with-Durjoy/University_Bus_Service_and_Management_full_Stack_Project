
<?php
$student_id = $_POST['student_id'];
$date = date('Y-m-d');

$conn = new mysqli("localhost", "root", "", "bus_service");

if ($conn->connect_error) {
    header("Location: booking.php?error=Database Connection Failed");
    exit();
}

$stmt = $conn->prepare("DELETE FROM bookings WHERE student_id = ? AND date = ?");
$stmt->bind_param("ss", $student_id, $date);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header("Location: booking.php?success=Booking Cancelled Successfully!");
} else {
    header("Location: booking.php?error=No Booking Found to Cancel!");
}

$conn->close();
?>
