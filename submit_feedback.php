<?php
$conn = new mysqli("localhost", "root", "", "bus_service");

$student_id = $_POST['student_id'];
$feedback = $_POST['feedback'];
$date = date('Y-m-d');

$image_path = null;
if (!empty($_FILES['image']['name'])) {
    $target_dir = "uploads/feedbacks/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
    $target_file = $target_dir . time() . '_' . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image_path = $target_file;
}

$stmt = $conn->prepare("INSERT INTO feedbacks (student_id, feedback, date, image_path) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $student_id, $feedback, $date, $image_path);
$stmt->execute();

header("Location: student_portal.php?success=Feedback Submitted");
?>
