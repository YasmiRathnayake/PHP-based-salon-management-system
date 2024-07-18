
<?php
    session_start();


?>




<?php

  include 'header.php';
  

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cosmetic store</title>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="assets/css/style.css"/>

    <style>

  
    </style>

</head>



<body>
    
<!--HOME SECTION-->
<section id="home">
    <div class="container">
        <h5>NEW ARRIVALS</h5>
        <h1><span>Explore Our Latest</span>  Cosmetic Products</h1>
        <p>Discover our newest cosmetic products at great prices!</p>

                        <!-- Conditionally enable/disable button -->
                        <?php if($authenticated): ?>
        <a href="shop.php"><button class="buy-btn" type="submit" name="add_to_cart">Shop Now</button></a>
        <?php else: ?>
                    <button class="buy-btn" disabled>Buy Now</button>
   
   
                    <?php endif; ?>
   
                  </div>
    
</section>







<!--FEATURED SECTION--> 
<section id="featured" class="my-5 pb-5">
    <div id="container text-center mt-5 py-5">
        <h3>Our Featured</h3>
        <hr>
        <p>Here you can check out our featured products</p>
    </div>
    <div class="row mx-auto containter-fluid">
        <?php include('server/get_featured_products.php'); ?>
        <?php while ($row = $featured_products->fetch_assoc()): ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price">LKR <?php echo $row['product_price']; ?></h4>
                <!-- Conditionally enable/disable button -->
                <?php if($authenticated): ?>
                    <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
                <?php else: ?>
                    <button class="buy-btn" disabled>Buy Now</button>
                    <p class="error-message">Please <a href="login.php">login</a> or <a href="register.php">register</a> to buy this product.</p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>


<!--BANNER-->
<section id="banner-2" class="my-5 py-5">
  <div class="container">
    <h4>Discover Your Perfect Look Here !</h4>
    <h1>Explore Our <span>Top-Notch Cosmetics </span> <br>  Find Your Signature Style</h1>
    <a href="shop.php"><button class="buy-btn" type="submit" name="add_to_cart">Shop Now</button></a>
  </div>
</section>
    






<!--hair care products-->
<section id="skin" class="my-5 ">
  <div id="container text-center mt-5 py-5">
    <h3>Hair Care Products</h3>
    <hr>
    <p>Here you can check out our hair care products</p>
  </div>
  <div class="row mx-auto containter-fluid">

  
  <?php include('server/get_hair_care_products.php');    ?>

  <?php while ($row = $hair_care_products->fetch_assoc()): ?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                <h4 class="p-price">LKR <?php echo $row['product_price']; ?></h4>
                
    
                <!-- Conditionally enable/disable button -->
                <?php if($authenticated): ?>
                    <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
                <?php else: ?>
                    <button class="buy-btn" disabled>Buy Now</button>
                    <p class="error-message">Please <a href="login.php">login</a> or <a href="register.php">register</a> to buy this product.</p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<!-- end of hair care products-->






<!--Skin care products-->
<section id="skin" class="my-5 ">
  <div id="container text-center mt-5 py-5">
    <h3>Skin Care Products</h3>
    <hr>
    <p>Here you can check out our skin care products</p>
  </div>
  <div class="row mx-auto containter-fluid">

  
  <?php include('server/get_skin_care_products.php');    ?>

  <?php while ($row = $skin_care_products->fetch_assoc()): ?>


  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
  <img class="img-fluid mb-3" src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
  
  <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
    <h4 class="p-price">LKR <?php echo $row['product_price']; ?></h4>
    <!-- Conditionally enable/disable button -->
    <?php if($authenticated): ?>
                    <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
                <?php else: ?>
                    <button class="buy-btn" disabled>Buy Now</button>
                    <p class="error-message">Please <a href="login.php">login</a> or <a href="register.php">register</a> to buy this product.</p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<!--end of care products-->






<!--Body care products-->
<section id="body" class="my-5 ">
  <div id="container text-center mt-5 py-5">
    <h3>Body Care Products</h3>
    <hr>
    <p>Here you can check out our body care products</p>
  </div>
  <div class="row mx-auto containter-fluid">

  <?php include('server/get_body_care_products.php');    ?>

  <?php while ($row = $body_care_products->fetch_assoc()): ?>

  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
  <img class="img-fluid mb-3" src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">

    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
    <h4 class="p-price">LKR <?php echo $row['product_price']; ?></h4>

                <!-- Conditionally enable/disable button -->
                <?php if($authenticated): ?>
                    <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
                <?php else: ?>
                    <button class="buy-btn" disabled>Buy Now</button>
                    <p class="error-message">Please <a href="login.php">login</a> or <a href="register.php">register</a> to buy this product.</p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<!-- end of Body care products-->






<!--Nail care products-->
<section id="nail" class="my-5 ">
  <div id="container text-center mt-5 py-5">
    <h3>Nail Care Products</h3>
    <hr>
    <p>Here you can check out our nail care products</p>
  </div>
  <div class="row mx-auto containter-fluid">

  <?php include('server/get_nail_care_products.php');    ?>

  <?php while ($row = $nail_care_products->fetch_assoc()): ?>



  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
  <img class="img-fluid mb-3" src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">

    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
    <h4 class="p-price">LKR <?php echo $row['product_price']; ?></h4>
                <!-- Conditionally enable/disable button -->
                <?php if($authenticated): ?>
                    <a href="single_product.php?product_id=<?php echo $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
                <?php else: ?>
                    <button class="buy-btn" disabled>Buy Now</button>
                    <p class="error-message">Please <a href="login.php">login</a> or <a href="register.php">register</a> to buy this product.</p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<!-- end of Nail care products-->






<?php

include 'footer.php';

?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>