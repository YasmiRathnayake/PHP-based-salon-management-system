<?php
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='hair' LIMIT 4");
$stmt->execute();
$hair_care_products = $stmt->get_result();

?>