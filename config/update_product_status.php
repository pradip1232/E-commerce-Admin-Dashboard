<?php
require 'db_con.php'; // adjust path as needed

// Get JSON body
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (isset($data['id'], $data['status'])) {
    $id = $data['id'];
    $status = $data['status'];

    // Update product status in DB
    $stmt = $conn->prepare("UPDATE products SET product_status = ? WHERE product_id = ?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
}
