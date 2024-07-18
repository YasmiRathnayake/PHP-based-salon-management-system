<?php

session_start();
error_reporting(0);

include ('server/connection.php');


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}



if(isset($_POST['submit'])){
    $product_name = $_POST['Product_name'];
    $product_category = $_POST['Product_category'];
    $product_brand = $_POST['Product_brand'];
    $product_description = $_POST['Product_description'];
    $product_weight = $_POST['Product_weight'];
    $product_quantity = $_POST['Product_quantity'];
    $product_price = $_POST['Product_price'];

    // File Upload Handling
    $product_image_name = $_FILES["Product_image"]["name"];
    $product_image_tmp = $_FILES["Product_image"]["tmp_name"];
    $upload_directory = "uploads/";
    $product_image_path = $upload_directory . $product_image_name;

    // Move uploaded file to uploads directory
    // Move uploaded file to uploads directory
if(move_uploaded_file($product_image_tmp, $product_image_path)){
    // Debug: Check if the file was successfully uploaded
    echo "File uploaded successfully.";
    
    $stmt = $conn->prepare("INSERT INTO products(product_name, product_category, product_brand, product_description, product_weight, product_quantity, product_price, product_image) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiiis", $product_name, $product_category, $product_brand, $product_description, $product_weight, $product_quantity, $product_price, $product_image_path);

    if($stmt->execute()){
        echo "<script>alert('Product added successfully');</script>";
        echo "<script>window.location.href = 'add-product.php';</script>";
    } else {
        echo "SQL Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    // Debug: Check if there's an error with file upload
    echo "File upload failed. Please check the uploads directory permissions.";
}
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css"/>

    <style>

        
#service-description {
    width: 100%; 
    height: 150px; 
    resize: both; /* Allows the textarea to be resizable */

}



    </style>

</head>
<body>

<?php

include 'admin-header.php';


?>


<!--REGISTRATION FORM-->
<section id="add-product" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Add New Cosmetic Product</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        



    <form method="POST" action="add-Product.php" id="add-service-form" enctype="multipart/form-data">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" class="form-control"  name="Product_name" placeholder="" required/>
            </div>

            <div class="form-group">
                    <label>Product Category</label>
                    <select class="form-control" name="Product_category" required>
                        <option value="" disabled selected>Select Product Category</option>
                        <option value="hair">Hair</option>
                        <option value="skin">Skin</option>
                        <option value="body">Body</option>
                        <option value="nail">Nail</option>
                    </select>
            </div>


            <div class="form-group">
                <label>Product Brand</label>
                <select class="form-control" name="Product_brand" required>
                        <option value="" disabled selected>Select Product Brand</option>
                        <option value="NIVEA">NIVEA</option>
                        <option value="Vatika">Vatika</option>
                        <option value="TRESemme">TRESemme</option>
                        <option value="Bellose">Bellose</option>
                        <option value="Neutrogena">Neutrogena</option>
                        <option value="Seren LONDON">Seren LONDON</option>
                        <option value="Basicare">Basicare</option>
                        <option value="Dr. Rashel">Dr. Rashel</option>
                        <option value="Rimmel LONDON">Rimmel LONDON</option>
                    </select>
            </div>


            <div class="form-group">
                <label>Product Description </label>
                <textarea type="text" class="form-control"  name="Product_description" placeholder="" required></textarea>
            </div>

            <div class="form-group">
                <label>Product Weight</label>
                <select class="form-control" name="Product_weight" required>
                        <option value="" disabled selected>Select Product Weight</option>
                        <option value="50g">50g</option>
                        <option value="100g">100g</option>
                        <option value="30ml">30ml</option>
                        <option value="50ml">50ml</option>
                        <option value="100ml">100ml</option>
                        <option value="200ml">200ml</option>
                        <option value="400ml">400ml</option>
                        <option value="500ml">500ml</option>
                        <option value="600ml">600ml</option>
                        <option value="750ml">750ml</option>
                        <option value="828ml">828ml</option>
                    </select>
            </div>


            <div class="form-group">
                <label>Product Quantity </label>
                <input type="number" name="Product_quantity" value="1" min="1"/>
            </div>


            <div class="form-group">
                <label>Product Price</label>
                <input type="text" class="form-control"  name="Product_price" placeholder="" required/>
            </div>

            <div class="form-group">
                <label>Product Image</label>
                <input type="file" class="form-control" name="Product_image" placeholder="" required style="height: 40px;"/>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" class="btn" id="add-service-btn" value="Add Product"/>
            </div>

            <div class="form-group">
                <a id="login-url" class="btn" href="">Go Back</a>
            </div>
        </form>
    </div>
</section>











  <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
