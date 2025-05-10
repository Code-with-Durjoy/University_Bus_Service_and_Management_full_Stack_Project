<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: index.php");
}


$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'bus_service';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';

// --- Handle Lost/Found Item Post ---
if (isset($_POST['submit_lost_found'])) {
    $item = $_POST['item'];
    $description = $_POST['description'];
    $status = $_POST['status']; // Lost or Found
    $date = date('Y-m-d');

    $image_path = '';
    if (!empty($_FILES['lost_image']['name'])) {
        $target_dir = "uploads/";
        $image_path = $target_dir . basename($_FILES["lost_image"]["name"]);
        move_uploaded_file($_FILES["lost_image"]["tmp_name"], $image_path);
    }

    $stmt = $conn->prepare("INSERT INTO lost_found (date, status, item, description, student_id, image_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $date, $status, $item, $description, $student_id, $image_path);
    $stmt->execute();
    $stmt->close();
}

// --- Handle Feedback ---
if (isset($_POST['submit_feedback'])) {
    $feedback = $_POST['feedback'];
    $date = date('Y-m-d');
    $image_path = '';

    if (!empty($_FILES['feedback_image']['name'])) {
        $target_dir = "uploads/";
        $image_path = $target_dir . basename($_FILES["feedback_image"]["name"]);
        move_uploaded_file($_FILES["feedback_image"]["tmp_name"], $image_path);
    }

    $stmt = $conn->prepare("INSERT INTO feedbacks (student_id, feedback, date, image_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $student_id, $feedback, $date, $image_path);
    $stmt->execute();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Portal</title>
    <link rel="stylesheet" href="styannou.css">
    
</head>
<body>
<header>
    <div class="logo">
          <img src="logo.png" alt="Logo">
        </div>
    <h1>Help & Feedback</h1>
    <nav>
            <ul>
                <li><a href="home_bus.php">Home</a></li>
                <li><a href="routs.php" class="active">Routes</a></li>
                <li><a href="schedule.php">Schedule</a></li>
                
                <li><a href="announcements.php">Announcements</a></li>
                <li><a href="booking.php">Seat-Booking</a></li>
                <li><a href="Registration.php">Registration</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="student_portal.php">Help</a></li>

            </ul>
        </nav>
</header>
<h2>📦 Report Lost or Found Item</h2>
<form id="feedback" method="POST" enctype="multipart/form-data">
    <input type="text" name="student_id" placeholder="Student ID" required><br>
    <select name="status" required>
        <option value="Lost">Lost</option>
        <option value="Found">Found</option>
    </select><br>
    <input type="text" name="item" placeholder="Item Name" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    Upload Image (optional): <input type="file" name="lost_image"><br>
    <button type="submit" name="submit_lost_found">Submit</button>
</form>

<hr>
<h2>📝 Submit Feedback or Complain</h2>
<form id="feedback" method="POST" enctype="multipart/form-data">
    <input type="text" name="student_id" placeholder="Student ID" required><br>
    <textarea name="feedback" placeholder="Write your feedback or complaint..." required></textarea><br>
    Attach Screenshot/Proof (optional): <input type="file" name="feedback_image"><br>
    <button type="submit" name="submit_feedback">Submit Feedback</button>
</form>

<hr>
<h2>📋 Lost and Found Board</h2>
<div id="display">
<h3>All Lost and Found Posts</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>Date</th>
        <th>Status</th>
        <th>Item</th>
        <th>Description</th>
        <th>Student ID</th>
        <th>Image</th>
    </tr>
<?php
$all_items = $conn->query("SELECT * FROM lost_found ORDER BY id DESC");
while ($row = $all_items->fetch_assoc()):
?>
<tr>
    <td><?= htmlspecialchars($row['date']) ?></td>
    <td><?= htmlspecialchars($row['status']) ?></td>
    <td><?= htmlspecialchars($row['item']) ?></td>
    <td><?= htmlspecialchars($row['description']) ?></td>
    <td><?= htmlspecialchars($row['student_id']) ?></td>
    <td>
        <?php if (!empty($row['image_path']) && file_exists($row['image_path'])): ?>
            <img src="<?= $row['image_path'] ?>" width="80">
        <?php else: ?>
            N/A
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>
</table>
</div>
<footer>
        <p>&copy; 2025 Green University of Bangladesh</p>
    </footer>
</body>
</html>
