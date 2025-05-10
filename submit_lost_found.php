<?php
$conn = new mysqli("localhost", "root", "", "bus_service");

$student_id = $_POST['student_id'];
$item = $_POST['item'];
$description = $_POST['description'];
$status = "Lost";
$date = date('Y-m-d');

$image_path = null;
if (!empty($_FILES['image']['name'])) {
    $target_dir = "uploads/lost_found/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
    $target_file = $target_dir . time() . '_' . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image_path = $target_file;
}

$stmt = $conn->prepare("INSERT INTO lost_found (student_id, item, description, status, date, image_path) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $student_id, $item, $description, $status, $date, $image_path);
$stmt->execute();

header("Location: student_portal.php?success=Lost Item Submitted");
?>
