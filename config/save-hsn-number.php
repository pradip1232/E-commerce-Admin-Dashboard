<?php

include "db_con.php";

// Read form values
$hsn = trim($_POST['hsnNumber']);
$desc = trim($_POST['hsnDescription']);

// Insert into DB
$stmt = $conn->prepare("INSERT INTO hsn_codes (hsn_number, description) VALUES (?, ?)");
$stmt->bind_param("ss", $hsn, $desc);

if ($stmt->execute()) {
  echo "HSN Number added successfully.";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
