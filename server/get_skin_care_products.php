<?php
include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='skin' LIMIT 4");
$stmt->execute();
$skin_care_products = $stmt->get_result();
?>

