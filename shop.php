<?php
include ('server/connection.php');

// Fetch all products from the database
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$result = $stmt->get_result();

$products = []; // Initialize an array to store products

// Fetch each row and store it in the products array
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
$stmt->close();
?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <!-- Add your CSS and other head elements here -->
</head>
<body>
    <?php include 'header.php'; ?>


    <section id="featured" class="my-5 py-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our Products</h3>
            <hr>
            <p>Here you can check out our products</p>
        </div>
        <div class="container">
            <div class="row">
                <!-- Output data of each product -->
<?php foreach ($products as $product) { ?>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <img class="card-img-top" src="<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                <h5 class="card-price">LKR. <?php echo $product['product_price']; ?></h5>
                <p class="card-text"><?php echo $product['product_brand']; ?></p>
                <!-- Button to view single product -->

                <a href="single_product.php?product_id=<?php echo $product['product_id'];?>"><button class="buy-btn">Buy Now</button></a>

            </div>
        </div>
    </div>
<?php } ?>

            </div>
        </div>
    </section>

    <!-- Pagination bar -->
    <div class="container mt-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <!-- Pagination links -->
                <!-- You can dynamically generate these links based on the total number of pages -->
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>


    <?php include 'footer.php'; ?>

    <!-- Add your scripts here -->
</body>
</html>
