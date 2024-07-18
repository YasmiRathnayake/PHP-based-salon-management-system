<?php
session_start();
error_reporting(0);
include('server/connection.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}




if(isset($_POST['submit'])){
    $product_name = $_POST['product_name'];
    $product_brand = $_POST['product_brand'];
    $product_category = $_POST['product_category'];
    $product_description = $_POST['product_description'];
    $product_weight = $_POST['product_weight'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    
    $eid = $_GET['editid'];  // Get the editid from URL
    
    $stmt = $conn->prepare("UPDATE products SET product_name=?, product_category=?, product_brand=?, product_description=?, product_weight=?, product_price=?, product_quantity=? WHERE product_id=?");
    $stmt->bind_param("sssssiii", $product_name, $product_category, $product_brand, $product_description, $product_weight, $product_price, $product_quantity, $eid);
    



    if($stmt->execute()){
        echo "<script>alert('Product Updated Successfully');</script>";
        echo "<script>window.location.href = 'manage-product.php';</script>";
    } else {
        echo "SQL Error: " . $stmt->error;
    }
    $stmt->close();
}


$cid = $_GET['editid'] ?? '';
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $cid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();  // Fetch a single row since we are editing one service
$stmt->close();




?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Update Services</title>
    <!-- Bootstrap Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel='stylesheet' type='text/css' />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<style>

#update-service {
            background-image: url('../imgs/register-page-background.jpg');
            width: 100%;
            height: auto;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        #edit-service-form {
            width: 40%;
            margin: 0 auto; 
            margin-bottom: 5px;
            text-align: center;
            padding: 20px;
            border-top: 1px solid darkgreen;
            position: relative;
            background: transparent;
            border: 2px solid rgba(255,255,255,.5);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0,0,0,.5);
            overflow: hidden; 
        }

        #edit-service-form .form-group {
            margin-bottom: 15px; /* Add margin bottom between form groups */
        }

        #edit-service-form label {
            margin-bottom: 5px; /* Add margin bottom between label and input */
            font-weight: bold;
            
        }

        #edit-service-form input{
            width: 100%;
            height: 50px;
            border-bottom: 2px solid #162938;
        }
        #edit-service-form textarea {
            width: 100%;
            height: 100px;
            border-bottom: 2px solid #162938;
        }

        #edit-service-form .btn {
            background-color: lightcoral;
            color: white;
        }
        
        #edit-service-form  .btn-update-img {
            background-color: darkred;
            color: white;
        }



</style>




</head>
<body>
    
<?php 
            include 'admin-header.php';
        ?>



    <!-- Update Service Form -->
    <section id="update-service" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Update Salon Product</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        <form method="POST" id="edit-service-form">
        
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" name="product_name" placeholder="" value="<?php echo $row['product_name']; ?>" required>
        </div>

        <div class="form-group">
            <label>Product Category</label>
            <select class="form-control" name="product_category" required>
                <option value="" disabled>Select Product Category</option>
                <option value="hair" <?php echo ($row['product_category'] == 'hair') ? 'selected' : ''; ?>>Hair</option>
                <option value="skin" <?php echo ($row['product_category'] == 'skin') ? 'selected' : ''; ?>>Skin</option>
                <option value="body" <?php echo ($row['product_category'] == 'body') ? 'selected' : ''; ?>>Body</option>
                <option value="nail" <?php echo ($row['product_category'] == 'nail') ? 'selected' : ''; ?>>Nail</option>
            </select>
        </div>

        <div class="form-group">
            <label>Product Brand</label>
            <select class="form-control" name="product_brand" required>
                <option value="" disabled>Select Product Brand</option>
                <option value="NIVEA" <?php echo ($row['product_brand'] == 'NIVEA') ? 'selected' : ''; ?>>NIVEA</option>
                <option value="Vatika" <?php echo ($row['product_brand'] == 'Vatika') ? 'selected' : ''; ?>>Vatika</option>
                <option value="TRESemme" <?php echo ($row['product_brand'] == 'TRESemme') ? 'selected' : ''; ?>>TRESemme</option>
                <option value="Bellose" <?php echo ($row['product_brand'] == 'Bellose') ? 'selected' : ''; ?>>Bellose</option>
                <option value="Neutrogena" <?php echo ($row['product_brand'] == 'Neutrogena') ? 'selected' : ''; ?>>Neutrogena</option>
                <option value="Seren LONDON" <?php echo ($row['product_brand'] == 'Seren LONDON') ? 'selected' : ''; ?>>Seren LONDON</option>
                <option value="Basicare" <?php echo ($row['product_brand'] == 'Basicare') ? 'selected' : ''; ?>>Basicare</option>
                <option value="Dr. Rashel" <?php echo ($row['product_brand'] == 'Dr. Rashel') ? 'selected' : ''; ?>>Dr. Rashel</option>
                <option value="Rimmel LONDON" <?php echo ($row['product_brand'] == 'Rimmel LONDON') ? 'selected' : ''; ?>>Rimmel LONDON</option>
            </select>        </div>


        <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control" name="product_description" required><?php echo $row['product_description']; ?></textarea>
        </div>


        <div class="form-group">
            <label>Product Weight</label>
            <select class="form-control" name="product_weight" required>
                <option value="" disabled>Select Product Weight</option>
                <option value="50g" <?php echo ($row['product_weight'] == '50g') ? 'selected' : ''; ?>>50g</option>
                <option value="100g" <?php echo ($row['product_weight'] == '100g') ? 'selected' : ''; ?>>100g</option>
                <option value="30ml" <?php echo ($row['product_weight'] == '30ml') ? 'selected' : ''; ?>>30ml</option>
                <option value="50ml" <?php echo ($row['product_weight'] == '50ml') ? 'selected' : ''; ?>>50ml</option>
                <option value="100ml" <?php echo ($row['product_weight'] == '100ml') ? 'selected' : ''; ?>>100ml</option>
                <option value="200ml" <?php echo ($row['product_weight'] == '200ml') ? 'selected' : ''; ?>>200ml</option>
                <option value="400ml" <?php echo ($row['product_weight'] == '400ml') ? 'selected' : ''; ?>>400ml</option>
                <option value="500ml" <?php echo ($row['product_weight'] == '500ml') ? 'selected' : ''; ?>>500ml</option>
                <option value="600ml" <?php echo ($row['product_weight'] == '600ml') ? 'selected' : ''; ?>>600ml</option>
                <option value="750ml" <?php echo ($row['product_weight'] == '750ml') ? 'selected' : ''; ?>>750ml</option>
                <option value="828ml" <?php echo ($row['product_weight'] == '828ml') ? 'selected' : ''; ?>>828ml</option>
            </select>
        </div>


        <div class="form-group">
            <label>Product Quantity</label>
            <input type="number" class="form-control" name="product_quantity" value="<?php echo $row['product_quantity']; ?>" min="1" required>
        </div>


        <div class="form-group">
            <label>Product Price</label>
            <input type="text" class="form-control" name="product_price" placeholder="" value="<?php echo $row['product_price']; ?>" required>
        </div>


        <div class="form-group">
    <label>Product Image</label><br>
    <?php 
    $image_path = $row['product_image'];
    if (file_exists($image_path)) {
        echo "<img src=\"$image_path\" width=\"50%\" height=\"50%\">";
    } else {
        echo "Image not found";
    }
    ?>
    <br><br>
    <a href="update-product-image.php?sid=<?php echo $row['product_id'];?>" class="btn btn-update-img">Change Image</a> 
</div>



            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-default" value="Update Product"/>
            </div>


            <div class="form-group">
                    <a id="login-url" class="btn" href="manage-product.php">Go Back</a>
                </div>


        </form>



    </div>
</section>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

   

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>