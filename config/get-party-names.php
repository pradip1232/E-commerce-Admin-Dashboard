<?php
include "db_con.php";

$sql = "SELECT id, party_name FROM party_table";
$result = $conn->query($sql);

$parties = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $parties[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($parties);
