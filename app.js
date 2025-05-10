document.getElementById('busForm').addEventListener('submit', function (e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch('save_student.php', {
    method: 'POST',
    body: formData
  })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'exists') {
        document.getElementById('successMessage').innerText = "Error: Student ID already exists.";
        document.getElementById('successMessage').style.color = "red";
      } else {
        document.getElementById('successMessage').innerText = "Registration successful!";
        document.getElementById('successMessage').style.color = "green";
        document.getElementById('busInfo').innerText = `Assigned to Bus #${data.bus_number} (${data.location})`;
        document.getElementById('busForm').reset();
      }
    })
    .catch(() => {
      document.getElementById('successMessage').innerText = "Error: Registration failed.";
      document.getElementById('successMessage').style.color = "red";
    });
});

function loadEvaluationChart() {
  fetch('get_daily_counts.php')
    .then(res => res.json())
    .then(data => {
      const ctx = document.getElementById('evaluationChart').getContext('2d');
      const labels = data.map(d => d.date);
      const locations = ['Shewrapara', 'Shamoly', 'Dhanmondi','Mohakhali','Agargao','Kuril','Arai Hazar'];

      const datasets = locations.map(loc => {
        let cumulative = 0;
        const cumulativeData = data.map(entry => {
          cumulative += entry[loc] || 0;
          return cumulative;
        });

        return {
          label: loc,
          data: cumulativeData,
          borderWidth: 2,
          borderColor: getColor(loc),
          fill: false,
          tension: 0.3
        };
      });

      new Chart(ctx, {
        type: 'line',
        data: {
          labels,
          datasets
        },
        options: {
          responsive: true,
          plugins: {
            tooltip: {
              callbacks: {
                label: function (context) {
                  const students = context.raw;
                  const buses = Math.ceil(students / 50);
                  return `${context.dataset.label}: ${students} students, ${buses} bus(es)`;
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Number of Students'
              }
            },
            x: {
              title: {
                display: true,
                text: 'Date'
              }
            }
          }
        }
      });

      // Display the number of buses needed for each location below the chart
      let busInfoHTML = '<h3>Buses Needed per Location</h3>';
      locations.forEach(loc => {
        const totalStudents = data.reduce((sum, entry) => sum + (entry[loc] || 0), 0);
        const busesNeeded = Math.ceil(totalStudents / 50);
        busInfoHTML += `<p>${loc}: ${busesNeeded} bus for ${totalStudents} students</p>`;
      });
      document.getElementById('busInfo').innerHTML = busInfoHTML;
    });
}

function getColor(location) {
  switch (location) {
    case 'Shewrapara': return 'rgba(75, 192, 192, 1)';
    case 'Shamoly': return 'rgba(255, 99, 132, 1)';
    case 'Dhanmondi': return 'rgba(255, 206, 86, 1)';
    case 'Mohakhali': return 'rgb(169, 191, 0)';
    case 'Agargao': return 'rgb(0, 0, 0)';
    case 'Kuril': return 'rgb(0, 148, 32)';
    case 'Arai Hazar': return 'rgb(248, 4, 150)';
    default: return 'rgba(153, 102, 255, 1)';
  }
}
