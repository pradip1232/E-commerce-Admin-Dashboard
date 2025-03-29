<?php
require 'db_con.php'; // Include your database connection

// Prepare the SQL statement to fetch products
$sql = "SELECT product_id, product_name FROM products";
$result = $conn->query($sql);

// Initialize an array to hold the products
$products = [];

// Fetch all products
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Return the products as JSON
echo json_encode(['products' => $products]);

// Close the database connection
$conn->close();
?>