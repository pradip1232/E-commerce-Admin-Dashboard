<?php
include "db_con.php";





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $category = $_POST['category'];
  $from_dates = $_POST['from_date'];
  $tax_rates = $_POST['tax_rate'];



  foreach ($from_dates as $index => $date) {
    $rate = $tax_rates[$index];
    $sql = "INSERT INTO tax_rates (category, tax_rate, from_date) VALUES ('$category', '$rate', '$date')";
    $conn->query($sql);
  }

  echo "Tax rates saved successfully.";
  $conn->close();
}
?>










<!-- // // Read form values
// $rate = floatval($_POST['taxRate']);
// $start = $_POST['startDate'];
// $end = $_POST['endDate'];

// // Insert into DB
// $stmt = $conn->prepare("INSERT INTO tax_rates (rate, start_date, end_date) VALUES (?, ?, ?)");
// $stmt->bind_param("dss", $rate, $start, $end);

// if ($stmt->execute()) {
// echo "Tax Rate added successfully.";
// } else {
// echo "Error: " . $stmt->error;
// }

// $stmt->close();
// $conn->close();
// ?> -->