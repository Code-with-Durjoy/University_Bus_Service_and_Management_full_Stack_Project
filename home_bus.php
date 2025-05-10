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
  <title>Green University Bus Service</title>
  <link rel="stylesheet" href="stylehome.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
  <div style="background-color: rgb(243, 243, 242);">
    <header>
      <div class="logo">
        <img src="logo.png" alt="Logo">
      </div>
      <h1>Green University Bus Service</h1>
      <nav>
        <ul>
          <li><a href="home_bus.php">Home</a></li>
          <li><a href="routs.php">Routes</a></li>
          <li><a href="schedule.php">Schedule</a></li>
          <li><a href="announcements.php">Announcements</a></li>
          <li><a href="booking.php">Seat-Booking</a></li>
          <li><a href="Registration.php">Registration</a></li>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="student_portal.php">Help</a></li>
        </ul>
      </nav>
    </header>

    <section class="main-content">
      <h2><i class="bi bi-bus-front"></i> Welcome to Our Smart Bus System</h2>
      <p>Manage your daily commute with ease. Check routes, schedules, and book seats right from one place!</p>
      <div class="link-grid">
        <div class="link-card">
          <i class="bi bi-calendar3"></i>
          <h3>Schedule</h3>
          <a href="schedule.php">View Timings</a>
        </div>
        <div class="link-card">
          <i class="bi bi-geo-alt"></i>
          <h3>Routes</h3>
          <a href="routs.php">Explore Routes</a>
        </div>
        <div class="link-card">
          <i class="bi bi-ticket"></i>
          <h3>Booking</h3>
          <a href="booking.php">Book Your Seat</a>
        </div>
        <div class="link-card">
          <i class="bi bi-bullhorn"></i>
          <h3>Announcements</h3>
          <a href="announcements.php">Latest Updates</a>
        </div>
        <div class="link-card">
          <i class="bi bi-person-plus"></i>
          <h3>Register</h3>
          <a href="Registration.php">Student Signup</a>
        </div>
        <div class="link-card">
          <i class="bi bi-question-circle"></i>
          <h3>Support</h3>
          <a href="student_portal.php">Get Help</a>
        </div>
      </div>
    </section>

    <section id="features">
      <h2><i class="bi bi-lightning-charge"></i> Why Choose Us?</h2>
      <ul>
        <li><i class="bi bi-check-circle"></i> Real-time updates and seat availability</li>
        <li><i class="bi bi-check-circle"></i> Route-specific announcements</li>
        <li><i class="bi bi-check-circle"></i> Smooth daily transport experience</li>
        <li><i class="bi bi-check-circle"></i> Eco-friendly transport initiative</li>
      </ul>
    </section>

    <section id="contact">
      <h2><i class="bi bi-envelope"></i> Contact Us</h2>
      <form id="contact-form" action="send_mail.php" method="POST">
        <label for="email"><h4>Email:</h4></label>
        <p><a href="mailto:admission@green.edu.bd">admission@green.edu.bd</a></p>
        <label for="phone"><h4>Phone:</h4></label>
        <p>01xxxxxxxxx</p>
      </form>
    </section>

    <footer>
      <p>&copy; 2025 Green University of Bangladesh</p>
    </footer>
  </div>
</body>
</html>
