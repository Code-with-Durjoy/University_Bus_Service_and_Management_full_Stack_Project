<?php
$conn = new mysqli("localhost", "root", "", "bus_service");
if ($conn->connect_error) die("Connection failed");

$today = date('Y-m-d');
$data = ['1pm' => 0, '3pm' => 0];

$sql = "SELECT time_slot, COUNT(*) as total FROM return_bookings WHERE booking_date = '$today' GROUP BY time_slot";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $data[$row['time_slot']] = (int)$row['total'];
}

echo json_encode($data);
?>
