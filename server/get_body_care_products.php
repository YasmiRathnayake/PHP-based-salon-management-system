<?php
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='body' LIMIT 4");
$stmt->execute();
$body_care_products = $stmt->get_result();

?>
