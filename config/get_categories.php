<?php

require 'db_con.php'; // Include your database connection

// Get the current page number for pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Number of categories per page
$offset = ($page - 1) * $limit;

// Prepare the SQL statement to fetch categories and subcategories
$stmt = $conn->prepare("SELECT category_id, category_name, sub_category_name FROM categories LIMIT ?, ?");
$stmt->bind_param("ii", $offset, $limit);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

// Fetch all categories
$categories = '';
while ($row = $result->fetch_assoc()) {
    $categories .= "<tr>
        <td>{$row['category_id']}</td>
        <td>{$row['category_name']}</td>
        <td>{$row['sub_category_name']}</td>
        <td>
            <button class='btn btn-danger' onclick='deleteCategory({$row['category_id']})'>Delete</button>
        </td>
    </tr>";
}

// Get total number of categories for pagination
$totalResult = $conn->query("SELECT COUNT(*) as total FROM categories");
$totalCategories = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalCategories / $limit);

// Prepare pagination links
$pagination = '';
for ($i = 1; $i <= $totalPages; $i++) {
    $activeClass = ($i == $page) ? 'active' : '';
    $pagination .= "<li class='page-item $activeClass'><a class='page-link' href='?page=$i'>$i</a></li>";
}

// Return the categories and pagination as JSON
echo json_encode([
    'categories' => $categories,
    'pagination' => $pagination
]);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
