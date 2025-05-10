<?php
$conn = new mysqli("localhost", "root", "", "bus_service");

$query = "SELECT location, COUNT(*) as total FROM students GROUP BY location";
$result = $conn->query($query);

$locations = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
  $locations[] = $row['location'];
  $counts[] = $row['total'];
}

echo json_encode([
  "locations" => $locations,
  "counts" => $counts
]);
?>
