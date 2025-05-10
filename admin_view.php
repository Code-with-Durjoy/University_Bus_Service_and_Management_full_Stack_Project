<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: adminlogin.php");
    exit();
}

?>
<?php
$conn = new mysqli("localhost", "root", "", "bus_service");

// Update feedback remarks if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_feedback'])) {
    $id = $_POST['feedback_id'];
    $remarks = $_POST['remarks'];
    $conn->query("UPDATE feedbacks SET remarks='$remarks' WHERE id=$id");
}

// Fetch data
$feedbacks = $conn->query("SELECT * FROM feedbacks");
$losts = $conn->query("SELECT * FROM lost_found");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styannou.css">
</head>
<body>
<header>
    <div class="logo">
          <img src="logo.png" alt="Logo">
        </div>
        <h1>Bus Routes</h1>
        <nav>
            <ul>
               
                <li><a href="adminlogout.php">Logout</a></li>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                

            </ul>
        </nav>
    </header>
<h2>🔧 Admin Feedback Panel</h2>
<?php while($row = $feedbacks->fetch_assoc()): ?>
    <div style="border:1px solid #ccc;padding:10px;margin:10px">
        <strong>ID:</strong> <?= $row['student_id'] ?><br>
        <strong>Feedback:</strong> <?= $row['feedback'] ?><br>
        <?php if ($row['image_path']): ?>
            <img src="<?= $row['image_path'] ?>" width="100"><br>
        <?php endif; ?>
        <form method="POST">
            <input type="hidden" name="feedback_id" value="<?= $row['id'] ?>">
          
        </form>
    </div>
<?php endwhile; ?>

<hr>

<h2>📦 Lost Items Overview</h2>
<?php while($row = $losts->fetch_assoc()): ?>
    <div style="border:1px solid #ccc;padding:10px;margin:10px">
        <strong>Student ID:</strong> <?= $row['student_id'] ?><br>
        <strong>Item:</strong> <?= $row['item'] ?> (<?= $row['status'] ?>)<br>
        <strong>Description:</strong> <?= $row['description'] ?><br>
        <?php if ($row['image_path']): ?>
            <img src="<?= $row['image_path'] ?>" width="100"><br>
        <?php endif; ?>
       
    </div>
<?php endwhile; ?>

<footer>
        <p>&copy; 2025 Green University of Bangladesh</p>
    </footer>

    
</body>
</html>
