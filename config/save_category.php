<?php
// Allow from any origin
header("Access-Control-Allow-Origin: *");

// Allow specific HTTP methods
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Allow specific headers
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Set content type to JSON
header("Content-Type: application/json; charset=UTF-8");

// Handle preflight requests for CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit; // Exit early for preflight requests
}

require 'db_con.php'; // Include your database connection

// Get the category name and subcategory name from the POST request
$categoryName = isset($_POST['categoryName']) ? $_POST['categoryName'] : null;
$subCategoryName = isset($_POST['subCategoryName']) ? $_POST['subCategoryName'] : null;

// Prepare the SQL statement for category insertion
$stmt = $conn->prepare("INSERT INTO categories (category_name, sub_category_name, created_at) VALUES (?, ?, NOW())");

// Check for errors in statement preparation
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Failed to prepare statement: " . $conn->error]);
    exit;
}

// Insert the main category and subcategory if provided
if ($categoryName || $subCategoryName) {
    $stmt->bind_param("ss", $categoryName, $subCategoryName);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Category '$categoryName' and Subcategory '$subCategoryName' inserted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error inserting category and subcategory: " . $stmt->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Category name and subcategory name cannot be empty."]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
