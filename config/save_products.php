<?php
// Allow from any origin
header("Access-Control-Allow-Origin: *");

// Allow specific HTTP methods
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Allow specific headers
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Set content type to JSON
header("Content-Type: application/json; charset=UTF-8");

// Handle preflight requests for CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit; // Exit early for preflight requests
}

// save_product.php

require 'db_con.php';

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO products (product_id, product_sku, product_name, product_category, hsn_number, tax_rate, key_benefits, description, product_benefits, product_usage, images, videos) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssisssssss", $product_id, $product_sku, $product_name, $product_category, $hsn_number, $tax_rate, $key_benefits, $description, $product_benefits, $product_usage, $images, $videos);

// Get the data from the POST request
$data = json_decode(file_get_contents("php://input"), true);

// Debugging: Check if data is received
if ($data === null) {
    echo "Debug: Invalid JSON input.\n";
    echo json_encode(["status" => "error", "message" => "Invalid JSON input."]);
    exit;
} else {
    echo "Debug: JSON input received successfully.\n";
}

// Initialize variables for images and videos
$uploadedImages = [];
$uploadedVideos = [];

// Handle file uploads for images
if (isset($_FILES['productImages'])) {
    foreach ($_FILES['productImages']['name'] as $key => $name) {
        if ($_FILES['productImages']['error'][$key] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['productImages']['tmp_name'][$key];
            $file_name = basename($name);
            $upload_dir = 'uploads/images/'; // Directory for images

            // Ensure the upload directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Generate a unique filename if it already exists
            $file_path = $upload_dir . $file_name;
            $counter = 1;
            while (file_exists($file_path)) {
                $file_path = $upload_dir . pathinfo($file_name, PATHINFO_FILENAME) . "_$counter." . pathinfo($file_name, PATHINFO_EXTENSION);
                $counter++;
            }

            // Move the uploaded file to the designated directory
            if (move_uploaded_file($tmp_name, $file_path)) {
                $uploadedImages[] = $file_path; // Store the file path for database insertion
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to upload image: $file_name"]);
                exit;
            }
        }
    }
}

// Handle file uploads for videos
if (isset($_FILES['productVideos'])) {
    foreach ($_FILES['productVideos']['name'] as $key => $name) {
        if ($_FILES['productVideos']['error'][$key] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['productVideos']['tmp_name'][$key];
            $file_name = basename($name);
            $upload_dir = 'uploads/videos/'; // Directory for videos

            // Ensure the upload directory exists
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Generate a unique filename if it already exists
            $file_path = $upload_dir . $file_name;
            $counter = 1;
            while (file_exists($file_path)) {
                $file_path = $upload_dir . pathinfo($file_name, PATHINFO_FILENAME) . "_$counter." . pathinfo($file_name, PATHINFO_EXTENSION);
                $counter++;
            }

            // Move the uploaded file to the designated directory
            if (move_uploaded_file($tmp_name, $file_path)) {
                $uploadedVideos[] = $file_path; // Store the file path for database insertion
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to upload video: $file_name"]);
                exit;
            }
        }
    }
}

// Prepare to insert data into the database
foreach ($data as $row) {
    // Debugging: Output the row data
    echo "Debug: Processing row data:\n";
    echo "Product ID: " . $row['product_id'] . "\n";
    echo "Product SKU: " . $row['product_sku'] . "\n";
    echo "Product Name: " . $row['product_name'] . "\n";
    echo "Product Category: " . $row['product_category'] . "\n";
    echo "HSN Number: " . $row['hsn_number'] . "\n";
    echo "Tax Rate: " . $row['tax_rate'] . "\n";
    echo "Key Benefits: " . $row['key_benefits'] . "\n";
    echo "Description: " . $row['description'] . "\n";
    echo "Product Benefits: " . $row['product_benefits'] . "\n";
    echo "Product Usage: " . $row['product_usage'] . "\n";
    $images = !empty($uploadedImages) ? implode(',', $uploadedImages) : ''; // Store image paths
    $videos = !empty($uploadedVideos) ? implode(',', $uploadedVideos) : ''; // Store video paths

    // Assign values to variables
    $product_id = $row['product_id'];
    $product_sku = $row['product_sku'];
    $product_name = $row['product_name'];
    $product_category = $row['product_category'];
    $hsn_number = $row['hsn_number'];
    $tax_rate = $row['tax_rate'];
    $key_benefits = $row['key_benefits'];
    $description = $row['description'];
    $product_benefits = $row['product_benefits'];
    $product_usage = $row['product_usage'];

    // Debugging: Output the prepared values
    echo "Debug: Prepared values for insertion:\n";
    echo "Product ID: $product_id\n";
    echo "Product SKU: $product_sku\n";
    echo "Product Name: $product_name\n";
    echo "Product Category: $product_category\n";
    echo "HSN Number: $hsn_number\n";
    echo "Tax Rate: $tax_rate\n";
    echo "Key Benefits: $key_benefits\n";
    echo "Description: $description\n";
    echo "Product Benefits: $product_benefits\n";
    echo "Product Usage: $product_usage\n";
    echo "Images: $images\n";
    echo "Videos: $videos\n";

    // Execute the statement
    if (!$stmt->execute()) {
        echo "Debug: Database error: " . $stmt->error . "\n";
        echo json_encode(["status" => "error", "message" => "Database error: " . $stmt->error]);
        exit;
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();

echo json_encode(["status" => "success", "message" => "Products saved successfully."]);
?>
