<?php
include "db_con.php";


$names = $_POST['party_name'] ?? [];
$datetimes = $_POST['datetime'] ?? [];

if (count($names) > 0 && count($names) === count($datetimes)) {
    foreach ($names as $i => $name) {
        $party = $conn->real_escape_string($name);
        $dt = $conn->real_escape_string($datetimes[$i]);
        $conn->query("INSERT INTO party_table (party_name, created_at) VALUES ('$party', '$dt')");
    }
    echo "Data saved successfully!";
} else {
    echo "Invalid data!";
}


// CREATE TABLE `party_table` (
//   `id` INT AUTO_INCREMENT PRIMARY KEY,
//   `party_name` VARCHAR(255) NOT NULL,
//   `created_at` DATETIME NOT NULL
// );
