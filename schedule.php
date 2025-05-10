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
    <title>Schedule</title>
    <link rel="stylesheet" href="styannou.css">
</head>
<body>
    <header>
    <div class="logo">
          <img src="logo.png" alt="Logo">
        </div>
        <h1>Bus Schedule</h1>
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
    <main>
        <h3>Check out our bus schedule.</h3>
        <div class="schedule-table">
        <table>
                <thead>
                    <tr>
                        <th>Stoppages</th>
                        <th>1<sup>st</sup> Trip (Pickup time)</th>
                        <th>2<sup>nd</sup> Trip (Pickup time)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sewrapara Bus Stand</td>
                        <td>7:00 AM</td>
                        <td>9:30 AM</td>
                    </tr>
                    <tr>
                        <td>Mirpur 10</td>
                        <td>7:05 AM</td>
                        <td>9:35 AM</td>
                    </tr>
                    <tr>
                        <td>Mirpur 11</td>
                        <td>7:10 AM</td>
                        <td>9:40 AM</td>
                    </tr>
                    <tr>
                        <td>Pallabi</td>
                        <td>7:12 AM</td>
                        <td>9:37 AM</td>
                    </tr>
                    <tr>
                        <td>Kalshi</td>
                        <td>7:20</td>
                        <td>9:45 AM</td>
                    </tr>
                    <tr>
                        <td>Ecb</td>
                        <td>7:30 AM</td>
                        <td>9:55 AM</td>
                    </tr>
                    <tr>
                        <td>Kuril</td>
                        <td>7:45 AM</td>
                        <td>10:05 AM</td>
                    </tr>
                    <tr>
                        <td>Basundhara</td>
                        <td>7:55 AM</td>
                        <td>10:15 AM</td>
                    </tr>
                    <tr>
                        <td>Kanchan</td>
                        <td>8:10 AM</td>
                        <td>10:30 AM</td>
                    </tr>
                    <tr>
                        <td>GUB</td>
                        <td>8:20 AM</td>
                        <td>10:40 AM</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Green University of Bangladesh</p>
    </footer>
</body>
</html>
