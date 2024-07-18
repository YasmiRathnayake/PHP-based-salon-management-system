<?php
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='nail' LIMIT 4");
$stmt->execute();
$nail_care_products = $stmt->get_result();
?>
