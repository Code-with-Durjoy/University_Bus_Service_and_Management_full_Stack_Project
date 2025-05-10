<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routes</title>
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
    <main>
        <div class="route">
            <h3>Check out our bus schedule.</h3>
            <div class="route-card">
                <p class="route-title">Route 1:</p>
                <pre class="route-details">Sewrapara => Mirpur10 => Kalshi => Kuril => Campus</pre>
            </div>
            <div class="route-card">
                <p class="route-title">Route 2:</p>
                <pre class="route-details" hight="40px">Sewrapara => Agargaon => Mohakhali => Banani => Kuril => Campus</pre>
            </div>
            <div class="route-card">
                <p class="route-title">Route 3:</p>
                <pre class="route-details">Shymoli => Dhaka Technicle => Gabtoli => Majar Road => Mirpur1 => Mirpur2 => Mirpur11 => Kalshi => Kuril => Campus</pre>
            </div>
            <div class="route-card">
                <p class="route-title">Route 4:</p>
                <pre class="route-details">Azimpur => New Market => Science Lab => Sahbag => Firmgate => Bijoy Soroni => Mohakhali => Kuril => Campus</pre>
            </div>
            <div class="route-card">
                <p class="route-title">Route 5:</p>
                <pre class="route-details">Motijheel => Komlapur => Basabo => Khilgaon => Malibag => Abul Hotel => Rampura => Badda => Natun Bazar => Kuril => Campus</pre>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Green University of Bangladesh</p>
    </footer>
</body>

</html>
