<?php
$conn = new mysqli("localhost", "root", "", "bus_service");

// Define all possible locations and slots
$locations = ["Shewrapara", "Shymoly", "Agargaon", "Mahakhali", "Kuril", "Arai Hazar"];
$slots = ["1PM", "3PM"];

$sql = "SELECT date, location, slot, COUNT(*) as count
        FROM bookings
        GROUP BY date, location, slot
        ORDER BY date ASC";
$result = $conn->query($sql);

$temp = [];
while ($row = $result->fetch_assoc()) {
    $date = $row['date'];
    $location = $row['location'];
    $slot = $row['slot'];
    $count = $row['count'];

    if (!isset($temp[$date])) {
        $temp[$date] = ['date' => $date];
    }
    if (!isset($temp[$date][$location])) {
        $temp[$date][$location] = [];
    }
    $temp[$date][$location][$slot] = (int)$count;
}

// Ensure all locations and slots exist per date, even if 0
foreach ($temp as $date => &$entry) {
    foreach ($locations as $loc) {
        if (!isset($entry[$loc])) {
            $entry[$loc] = [];
        }
        foreach ($slots as $slot) {
            if (!isset($entry[$loc][$slot])) {
                $entry[$loc][$slot] = 0;
            }
        }
    }
}

echo json_encode(array_values($temp));
?>
