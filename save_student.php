<?php
$conn = new mysqli("localhost", "root", "", "bus_service");

$name = $_POST['name'];
$dept = $_POST['department'];
$student_id = $_POST['student_id'];
$batch = $_POST['batch'];
$location = $_POST['location'];

// Check if student ID already exists
$check = $conn->prepare("SELECT id FROM students WHERE student_id = ?");
$check->bind_param("s", $student_id);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
  echo json_encode(['status' => 'exists']);
  exit;
}

// Count students from this location to assign bus number
$stmt = $conn->prepare("SELECT COUNT(*) FROM students WHERE location = ?");
$stmt->bind_param("s", $location);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

$bus_number = intval($count / 50) + 1;

// Insert student
$insert = $conn->prepare("INSERT INTO students (name, department, student_id, batch, location, bus_number, created_at)
                          VALUES (?, ?, ?, ?, ?, ?, CURDATE())");
$insert->bind_param("sssssi", $name, $dept, $student_id, $batch, $location, $bus_number);
$insert->execute();

echo json_encode([
  'status' => 'success',
  'bus_number' => $bus_number,
  'location' => $location
]);
?>
