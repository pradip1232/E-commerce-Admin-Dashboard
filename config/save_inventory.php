<?php
include 'db_con.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

// Debugging: Print the received data
// echo "Received Data: ";
// print_r($data);
// echo "<br>";

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO inventory (product_id, product_name, custom_batch_name, mrp, discount, selling_price, stock_quantity, packagingwithunit, manufacturing_date, expiration_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Check if the statement was prepared successfully
if (!$stmt) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    exit;
}

// Bind parameters
$stmt->bind_param("sssdidsiss", $productId, $productName, $customBatchName, $mrp, $discount, $sellingPrice, $stockQuantity, $packagingwithunit, $manufacturingDate, $expirationDate);

// Loop through each inventory item and insert into the database
foreach ($data as $item) {
    $productId = $item['productId'];
    $productName = $item['productName'];
    $customBatchName = $item['customBatchName'];
    $mrp = $item['mrp'];
    $discount = $item['discount'];
    $sellingPrice = $item['sellingPrice'];
    $stockQuantity = $item['stockQuantity'];
    $packagingwithunit = $item['packagingwithunit'];
    $manufacturingDate = $item['manufacturingDate'];
    $expirationDate = $item['expirationDate'];

    // Debugging: Print the values being inserted
    // echo "Inserting: ";
    // echo "Product ID: $productId, Product Name: $productName, Custom Batch Name: $customBatchName, MRP: $mrp, Discount: $discount, Selling Price: $sellingPrice, Stock Quantity: $stockQuantity, Packaging with Unit: $packagingwithunit, Manufacturing Date: $manufacturingDate, Expiration Date: $expirationDate<br>";

    // Execute the statement
    if (!$stmt->execute()) {
        echo json_encode(['message' => 'Error: ' . $stmt->error]);
        exit;
    }
}

// Close connections
$stmt->close();
$conn->close();

// Return success message
echo json_encode(['message' => 'Inventory saved successfully.']);
?>