<?php
include 'db_con.php';

$unit = $_POST['unit'];
$category = $_POST['category'];
$gst_uqc = $_POST['gst_uqc'];
$type = $_POST['type'];
$ratio = $_POST['ratio'];
$rounding = $_POST['rounding'];
$active = isset($_POST['active']) ? 1 : 0;

$query = "INSERT INTO unit_measure 
(unit, category_id, gst_uqc, type, ratio, rounding_precision, active)
VALUES 
('$unit', '$category', '$gst_uqc', '$type', '$ratio', '$rounding', '$active')";

if (mysqli_query($conn, $query)) {
    echo "Unit saved successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>


<!-- 
// CREATE TABLE unit_measure (
    id INT AUTO_INCREMENT PRIMARY KEY,
    unit VARCHAR(50) NOT NULL,
    category_id INT NOT NULL,
    gst_uqc VARCHAR(50) NOT NULL,
    type VARCHAR(100) NOT NULL,
    ratio DECIMAL(18, 8) NOT NULL,
    rounding_precision DECIMAL(10, 5) NOT NULL,
    active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); -->