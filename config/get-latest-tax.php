<?php
require 'db_con.php'; // Adjust the path as needed

header('Content-Type: application/json');

if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = $conn->real_escape_string($_GET['category']);

    $sql = "SELECT tax_rate FROM tax_rates 
            WHERE category = '$category' 
            ORDER BY from_date DESC, created_at DESC 
            LIMIT 1";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['tax_rate' => $row['tax_rate']]);
    } else {
        echo json_encode(['tax_rate' => null]);
    }
} else {
    echo json_encode(['tax_rate' => null]);
}
