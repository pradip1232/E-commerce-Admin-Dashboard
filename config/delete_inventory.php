<?php
include 'db_con.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true); // Decode JSON data

// Debugging: Print the received data
// Removed echo for debugging to avoid confusion in response
// echo "Received Data: ";
// print_r($data);
// echo "<br>";

$id = $_POST['id'];
$name = $_POST['name'];

// Check if the product ID is provided
if (isset($id) && !empty($id)) { // Check if 'id' is in the decoded array and not empty
    // Debugging: Print the product ID being deleted
    // echo "Product ID to delete: $productId<br>";

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM inventory WHERE product_id = ?");
    
    // Check if the statement was prepared successfully
    if (!$stmt) {
        echo json_encode(['message' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    // Bind parameters
    $stmt->bind_param("s", $id); // Changed to 's' for string type
    // Debugging: Print statement preparation status
    // echo "Statement prepared and parameter bound.<br>";

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Product deleted successfully.']);
    } else {
        echo json_encode(['message' => 'Error: ' . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
    // Debugging: Print statement closure status
    // echo "Statement closed.<br>";
} else {
    echo json_encode(['message' => 'No product ID provided.']);
}

// Close the database connection
$conn->close();
// Debugging: Print database connection closure status
// echo "Database connection closed.<br>";
?>
