<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>University Bus Registration</title>
    <link rel="stylesheet" href="styannou.css" />
    <!-- You can create this later -->
  </head>
  <body>
    <header>
      <div class="logo">
        <img src="logo.png" alt="Logo" />
      </div>
      <h1>Registration</h1>
      <nav>
        <ul>
          <li><a href="home_bus.php">Home</a></li>
          <li><a href="routs.php">Routes</a></li>
          <li><a href="schedule.php" class="active">Schedule</a></li>
          <li><a href="announcements.php">Announcements</a></li>
          <li><a href="booking.php">Seat-Booking</a></li>
          <li><a href="Registration.php">Registration</a></li>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="student_portal.php">Help</a></li>

        </ul>
      </nav>
    </header>

    <h2>Registration Form</h2>
    <main>

    <form id="busForm">
      <input type="text" name="name" placeholder="Full Name" required /><br />
      <input
        type="text"
        name="department"
        placeholder="Department"
        required
      /><br />
      <input
        type="text"
        name="student_id"
        placeholder="Student ID"
        required
      /><br />
      <input type="text" name="batch" placeholder="Batch" required /><br />

      <select name="location" required>
        <option value="">-- Select Location --</option>
        <option value="Shewrapara">Shewrapara</option>
        <option value="Shamoly">Shamoly</option>
        <option value="Dhanmondi">Dhanmondi</option>
        <option value="Mohakhali">Mohakhali</option>
        <option value="Agargao">Agargao</option>
        <option value="Kuril">Kuril</option>
        <option value="Arai Hazar">Arai Hazar</option></select
      ><br />

      <button type="submit">Submit</button>
    </form>

    <h3 id="successMessage"></h3>

    <div class="btn">
    <button onclick="loadEvaluationChart()" type="eva">Evaluation</button>
    </div>
    <canvas id="evaluationChart" width="100" height="20"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="app.js"></script>

    <h3 id="busInfo"></h3>
  </main>

    <footer>
      <p>&copy; 2025 Green University of Bangladesh</p>
    </footer>
    <script src="script.js"></script>
  </body>
</html>
