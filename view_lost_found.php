<?php
$conn = new mysqli("localhost", "root", "", "bus_service");

$results = $conn->query("SELECT * FROM lost_found ORDER BY date DESC");
?>

<h3>All Lost and Found Posts</h3>
<table border="1">
  <tr><th>Date</th><th>Status</th><th>Item</th><th>Description</th><th>Student ID</th></tr>
  <?php while ($row = $results->fetch_assoc()): ?>
    <tr>
      <td><?= $row['date'] ?></td>
      <td><?= $row['status'] ?></td>
      <td><?= $row['item'] ?></td>
      <td><?= $row['description'] ?></td>
      <td><?= $row['student_id'] ?></td>
    </tr>
  <?php endwhile; ?>
</table>
