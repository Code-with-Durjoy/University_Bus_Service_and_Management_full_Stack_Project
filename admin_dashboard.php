<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: adminlogin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styannou.css">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', sans-serif;
    }

    body {
        display: flex;
        height: 100vh;
        
    }

    .main-content {
        
        width: 50%;
        margin-top: 0%;
        padding: 0%;
        margin-bottom: 0%;
    }
</style>
</head>

<body>
   
    <div class="main-content">
        <header>

            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <header>
                



                <h1 style="color:rgb(255, 255, 255);">Green University Bus Service-Dashboard 🌿</h1>
                <div class="link-grid" style="margin-bottom: 50px; margin-top: 50px; padding: 100px; background-color:rgb(15, 111, 78); border-radius: 25px;">
                    <div class="link-card"><a href="home_bus.php">Home</a></div>
                    <div class="link-card"><a href="routs.php">Routes</a></div>
                    <div class="link-card"><a href="schedule.php">Schedule</a></div>
                    <div class="link-card"><a href="announcements.php">Announcements</a></div>
                    <div class="link-card"><a href="booking.php">Seat-Booking</a></div>
                    <div class="link-card"><a href="Registration.php">Registration</a></div>
                    <div class="link-card"><a href="student_portal.php">Help</a></div>
                    <div class="link-card"style="background-color:rgb(0, 102, 157);"><a href="admin_view.php" style="color: white;" >View Feedbacks</a></div>
                    <div class="link-card" style="background-color:rgb(0, 102, 157);"><a href="post_announcement.php" style="color: white;">Post Announcement</a></div>
                    <div class="link-card" style="background-color:rgb(0, 102, 157); "><a href="logout.php" style="color: white;">Logout</a></div>
                </div>
    </div>
    <footer>
        <p>&copy; 2025 Green University of Bangladesh</p>
    </footer>
</body>

</html>