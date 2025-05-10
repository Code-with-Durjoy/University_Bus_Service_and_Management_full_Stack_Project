<?php
$student_id = $_POST['student_id'];
$slot = $_POST['slot'];
$location = $_POST['location'];
$date = date('Y-m-d');

$conn = new mysqli("localhost", "root", "", "bus_service");

if ($conn->connect_error) {
    header("Location: booking.php?error=Database Connection Failed");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM bookings WHERE student_id = ? AND date = ?");
$stmt->bind_param("ss", $student_id, $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO bookings (student_id, slot, location, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $student_id, $slot, $location, $date);
    if ($stmt->execute()) {
        header("Location: booking.php?success=Booking Successful!");
    } else {
        header("Location: booking.php?error=Failed to Book!");
    }
} else {
    header("Location: booking.php?error=You Already Booked Today!");
}

$conn->close();
?>
