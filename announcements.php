<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'bus_service';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcements</title>
    <link rel="stylesheet" href="styannou.css">
    <style>
       
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <h1>Announcements</h1>
    <nav>
        <ul>
            <li><a href="home_bus.php">Home</a></li>
            <li><a href="routs.php">Routes</a></li>
            <li><a href="schedule.php" class="active">Schedule</a></li>
            <li><a href="announcements.php">Announcements</a></li>
            <li><a href="booking.php">Seat-Booking</a></li>
            <li><a href="Registration.php">Registration</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="anno">
        <section id="announcements">
            <h2>Latest Announcements</h2>
            <div class="announcements-container">
                <?php
                $result = $conn->query("SELECT * FROM announcements ORDER BY created_at DESC");
                if ($result && $result->num_rows > 0):
                    $isFirst = true;
                    while ($row = $result->fetch_assoc()):
                ?>
                <div class="announcement-card <?= $isFirst ? 'latest-announcement' : '' ?>">
                    <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="Announcement Image">
                    <div class="announcement-date"><?= date("d-M-Y", strtotime($row['created_at'])) ?></div>
                    <div class="announcement-title"><?= htmlspecialchars($row['title']) ?></div>
                    <div class="announcement-description" id="desc-<?= $row['id'] ?>">
                        <?= nl2br(htmlspecialchars($row['description'])) ?>
                    </div>
                    <span class="read-more" onclick="toggleDescription('desc-<?= $row['id'] ?>', this)">Read more →</span>
                </div>
                <?php
                    $isFirst = false;
                    endwhile;
                else:
                    echo "<p>No announcements posted yet.</p>";
                endif;
                ?>
            </div>
        </section>
    </div>
</main>

<footer>
    <p>&copy; 2025 Green University of Bangladesh</p>
</footer>

<script>
    function toggleDescription(id, el) {
        const desc = document.getElementById(id);
        desc.classList.toggle('expanded');
        el.textContent = desc.classList.contains('expanded') ? "Show less ↑" : "Read more →";
    }
</script>
</body>
</html>
