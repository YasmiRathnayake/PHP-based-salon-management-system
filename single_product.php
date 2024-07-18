<?php
if(isset($_GET['product_id'])){

    include('server/connection.php');




    
    

    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    
    $product = $stmt->get_result();  // Get the selected product

    if ($product->num_rows > 0) {
        $product_data = $product->fetch_assoc();
        $product_category = $product_data['product_category'];
        
        // Query for related products
        $related_stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_id != ? LIMIT 4");
        $related_stmt->bind_param("si", $product_category, $product_id);
        $related_stmt->execute();
        $related_products = $related_stmt->get_result();
    } else {
        // Redirect if no product found
        header('Location: index.php');
        exit;
    }

    //no product id was given
} else {
    echo "product_id is not set"; // Debugging statement
    header('Location: index.php');
    exit; // Make sure to exit after redirection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmetic shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>
        .small-image-group{
            display: flex;
            justify-content: space-between;
        }
        .small-image-col{
            flex-basis: 24%;
            cursor: pointer;
        }
        .single-product input{
            width: 50px;
            height: 40px;
            padding-left: 10px;
            font-size: 16px;
            margin-right: 10px;
        }
        .single-product input:focus{
            outline: none;
        }
        .single-product .buy-btn{
            background-color: darkgreen;
            opacity: 1;
            transition: 0.4s all;
        }
        .single-product .buy-btn:hover{
            background-color: black;
        }
    </style>

    <?php include 'header.php'; ?>

    <!--SINGLE PRODUCTS-->
    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <img class="img-fluid w-100 pb-1" src="<?php echo $product_data['product_image']; ?>" id="mainImg" />
                    <div class="small-image-group">
                        <div class="small-image-col">
                            <img class="small-image" src="<?php echo $product_data['product_image']; ?>" width="100%" />
                        </div>
                        <div class="small-image-col">
                            <img class="small-image" src="assets/imgs/<?php echo $product_data['product_image2']; ?>" width="100%" />
                        </div>
                        <div class="small-image-col">
                            <img class="small-image" src="assets/imgs/<?php echo $product_data['product_image3']; ?>" width="100%" />
                        </div>
                        <div class="small-image-col">
                            <img class="small-image" src="assets/imgs/<?php echo $product_data['product_image4']; ?>" width="100%" />
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-12">
                    <h6><?php echo $product_data['product_category']; ?> / <?php echo $product_data['product_brand']; ?> / <?php echo $product_data['product_name']; ?></h6>
                    <h3 class="py-4"><?php echo $product_data['product_name']; ?></h3>
                    <h2>LKR <?php echo $product_data['product_price']; ?></h2> </br>

                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $product_data['product_id']; ?>" />
                        <input type="hidden" name="product_image" value="<?php echo $product_data['product_image']; ?>" />
                        <input type="hidden" name="product_name" value="<?php echo $product_data['product_name']; ?>" />
                        <input type="hidden" name="product_price" value="<?php echo $product_data['product_price']; ?>" />
                        
                        <input type="number" name="product_quantity" value="1" min="1"/>                        
                        <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button>
                    </form>
                   
                    <h4 class="mt-5 mb-5">Product Details</h4>
                    <p>Brand Name - <?php echo $product_data['product_brand']; ?></p>
                    <p>Weight - <?php echo $product_data['product_weight']; ?></p> </br>
                    <h4>Description</h4>
                    <p><?php echo $product_data['product_description']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <!--RELATED PRODUCTS--> 
    <section id="related-products" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Related Products</h3>
            <hr>
        </div>
        <div class="row mx-auto container-fluid">
            <?php while ($related_product = $related_products->fetch_assoc()) { ?>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="<?php echo $related_product['product_image']; ?>"/>

                    <h5 class="p-name"><?php echo $related_product['product_name']; ?></h5>
                    <h4 class="p-price">LKR <?php echo $related_product['product_price']; ?></h4>
                    <button class="buy-btn">Buy Now</button>
                </div>
            <?php } ?>
        </div>
    </section>
  
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        var smallImageGroup = document.querySelector('.small-image-group');
        var mainImg = document.getElementById('mainImg');
        var smallImages = smallImageGroup.querySelectorAll('.small-image');
        smallImages.forEach(function(smallImage) {
            smallImage.addEventListener('click', function(event) {
                var clickedSmallImgSrc = event.target.src;
                mainImg.src = clickedSmallImgSrc;
            });
        });
    </script>
</body>
</html>
