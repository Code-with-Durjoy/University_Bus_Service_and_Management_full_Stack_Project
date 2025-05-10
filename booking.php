<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sit Booking</title>
  <link rel="stylesheet" href="styannou.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
   
    canvas {
      max-width: 100%;
      height: 20px;
      margin-bottom: 150px;
      
    }
  </style>
</head>
<body class="Booking">
  <header>
    <div class="logo">
      <img src="logo.png" alt="Logo" />
    </div>
    <h1>Seat-Booking</h1>
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
    <div id="message" style="padding: 10px; margin-bottom: 20px; font-weight: bold;">
  <div class="booking">
  <form id="bookingForm" method="POST" action="book.php">
    <input type="text" name="student_id" placeholder="Student ID" required>
    <select name="slot">
      <option value="1PM">1PM</option>
      <option value="3PM">3PM</option>
    </select>
    <select name="location">
      <option value="Shewrapara">Shewrapara</option>
      <option value="Shymoly">Shymoly</option>
      <option value="Agargaon">Agargaon</option>
      <option value="Mahakhali">Mahakhali</option>
      <option value="Kuril">Kuril</option>
      <option value="Arai Hazar">Arai Hazar</option>
    </select>
    <button type="submit">Book</button>
  </form>

  <form id="cancelForm" method="POST" action="cancel.php">
    <input type="text" name="student_id" placeholder="Cancel by Student ID" required>
    <button type="submit">Cancel</button>
  </form>

</div>
 </div>
</main>


  <h2>Booking Summary Graph</h2>
  <canvas id="bookingChart"></canvas>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch("data.php")
            .then(response => response.json())
            .then(data => {
                const dates = data.map(d => d.date);
                const locations = ["Shewrapara", "Shymoly", "Agargaon", "Mahakhali", "Kuril", "Arai Hazar"];
                const slots = ["1PM", "3PM"];
                const slotColors = {
                    "1PM": [
                        "rgba(255, 99, 132, 0.7)",
                        "rgba(255, 159, 64, 0.7)",
                        "rgba(255, 205, 86, 0.7)",
                        "rgba(75, 192, 192, 0.7)",
                        "rgba(54, 162, 235, 0.7)",
                        "rgba(153, 102, 255, 0.7)"
                    ],
                    "3PM": [
                        "rgba(201, 203, 207, 0.7)",
                        "rgba(255, 99, 132, 0.5)",
                        "rgba(255, 159, 64, 0.5)",
                        "rgba(255, 205, 86, 0.5)",
                        "rgba(75, 192, 192, 0.5)",
                        "rgba(54, 162, 235, 0.5)"
                    ]
                };
    
                const datasets = [];
    
                slots.forEach((slot, slotIdx) => {
                    locations.forEach((loc, locIdx) => {
                        const dataset = {
                            label: `${loc} (${slot})`,
                            data: data.map(entry => entry[loc][slot]),
                            backgroundColor: slotColors[slot][locIdx],
                            stack: slot // Stack by slot (1PM or 3PM)
                        };
                        datasets.push(dataset);
                    });
                });
    
                const ctx = document.getElementById("bookingChart").getContext("2d");
                new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: dates,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: "Daily Bus Bookings per Location and Slot"
                            },
                            tooltip: {
                                mode: "index",
                                intersect: false
                            }
                        },
                        interaction: {
                            mode: "nearest",
                            axis: "x",
                            intersect: false
                        },
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: "Student Count"
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    });
 
    </script>
    
    

    loadGraph();
  </script>
  <script>
    function showMessage() {
      const params = new URLSearchParams(window.location.search);
      const messageDiv = document.getElementById('message');
      
      if (params.has('success')) {
        messageDiv.style.color = 'green';
        messageDiv.innerText = params.get('success');
      } else if (params.has('error')) {
        messageDiv.style.color = 'red';
        messageDiv.innerText = params.get('error');
      }
    }
    showMessage();
    </script>
    
  <footer>
    <p>&copy; 2025 Green University of Bangladesh</p>
  </footer>
</body>
</html>
