<?php

include "db_con.php";


// Fetch only distinct units to avoid duplicates (optional)
// DISTINCT
$query = "SELECT  unit FROM unit_measure WHERE active = 1"; // use DISTINCT to avoid duplicate rows
$result = mysqli_query($conn, $query);

$units = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Only if unit is not empty
    if (!empty($row['unit'])) {
        $units[] = ['unit' => $row['unit']];
    }
}

header('Content-Type: application/json');
echo json_encode($units);
