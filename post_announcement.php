<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'bus_service';
$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = date('Y-m-d');
    $image_path = '';

    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $image_path = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
    }

    $stmt = $conn->prepare("INSERT INTO announcements (title, description, image_path, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $image_path, $date);
    $stmt->execute();
    $stmt->close();

    $success_message = "✅ Announcement posted successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcements</title>
    <link rel="stylesheet" href="styannou.css">
    
<body>
<header>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <h1>Post Announcements</h1>
    <nav>
        <ul>
            
        <li><a href="adminlogout.php">Logout</a></li>
        <li><a href="admin_dashboard.php">Dashboard</a></li>
        </ul>
    </nav>
</header>
<div class="post_ano">
    <?php if (!empty($success_message)): ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php endif; ?>

<form id="announcementForm" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Announcement Title" required>
    <textarea name="description" placeholder="Description" rows="5" required></textarea>
    <label for="image">Upload Image:</label>
    <input type="file" name="image">
    <button type="submit">Post Announcement</button>
</form>
</div>
<footer>
    <p>&copy; 2025 Green University of Bangladesh</p>
</footer>
</body>
</html>