document.addEventListener('DOMContentLoaded', function () {
    const returnForm = document.getElementById('returnForm');
    const cancelForm = document.getElementById('cancelForm');
    const messageDiv = document.getElementById('message');
  
    returnForm.addEventListener('submit', e => {
      e.preventDefault();
      const formData = new FormData(returnForm);
      fetch('save_return_booking.php', {
        method: 'POST',
        body: formData
      }).then(res => res.json())
        .then(data => {
          messageDiv.style.color = data.status === 'success' ? 'green' : 'red';
          messageDiv.textContent = data.message;
          loadCharts();
          returnForm.reset();
        });
    });
  
    cancelForm.addEventListener('submit', e => {
      e.preventDefault();
      const formData = new FormData(cancelForm);
      fetch('cancel_return_booking.php', {
        method: 'POST',
        body: formData
      }).then(res => res.json())
        .then(data => {
          messageDiv.style.color = data.status === 'success' ? 'green' : 'red';
          messageDiv.textContent = data.message;
          loadCharts();
          cancelForm.reset();
        });
    });
  
    function loadCharts() {
      fetch('get_return_booking_data.php')
        .then(res => res.json())
        .then(data => {
          renderChart('chart1PM', data['13']);
          renderChart('chart3PM', data['15']);
        });
    }
  
    function renderChart(canvasId, chartData) {
      const ctx = document.getElementById(canvasId).getContext('2d');
      if (window[canvasId]) window[canvasId].destroy();
      window[canvasId] = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: chartData.locations,
          datasets: [
            {
              label: 'Students',
              data: chartData.students,
              backgroundColor: 'rgba(75, 192, 192, 0.6)'
            },
            {
              label: 'Buses Required',
              data: chartData.students.map(s => Math.ceil(s / 50)),
              backgroundColor: 'rgba(255, 99, 132, 0.6)'
            }
          ]
        },
        options: {
          responsive: true,
          plugins: {
            tooltip: {
              callbacks: {
                label: function(context) {
                  if (context.dataset.label === 'Buses Required') {
                    return `${context.dataset.label}: ${context.raw} bus(es)`;
                  } else {
                    return `${context.dataset.label}: ${context.raw} student(s)`;
                  }
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              title: { display: true, text: 'Count' }
            },
            x: {
              title: { display: true, text: 'Location' }
            }
          }
        }
      });
    }
  
    loadCharts();
  });
  