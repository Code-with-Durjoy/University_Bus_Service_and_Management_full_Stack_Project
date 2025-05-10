<?php
$host = 'localhost';
$db = 'bus_service';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode([]));
}

// Get unique dates
$date_query = "SELECT DISTINCT DATE(created_at) as date FROM students ORDER BY date ASC";
$date_result = $conn->query($date_query);

$locations = ['Shewrapara', 'Shamoly', 'Dhanmondi','Mohakhali','Agargao','Kuril','Arai Hazar'];
$data = [];

while ($row = $date_result->fetch_assoc()) {
    $date = $row['date'];
    $entry = ['date' => $date];

    foreach ($locations as $loc) {
        // Cumulative count up to that date
        $count_query = "SELECT COUNT(*) as total FROM students WHERE location = ? AND DATE(created_at) <= ?";
        $stmt = $conn->prepare($count_query);
        $stmt->bind_param("ss", $loc, $date);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        $entry[$loc] = (int)$count;
    }

    $data[] = $entry;
}

echo json_encode($data);
$conn->close();
?>