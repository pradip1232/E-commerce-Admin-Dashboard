<?php

require 'db_con.php'; // Include your database connection

// Prepare the SQL statement to fetch all categories and subcategories
$sql = "SELECT id, category_name, sub_category_name FROM categories";
$result = $conn->query($sql);

// Initialize an array to store the results
$categories = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Set content type to JSON
header('Content-Type: application/json');

// Return the categories as JSON
echo json_encode([
    'categories' => $categories
]);

// Close the connection
$conn->close();
?>
