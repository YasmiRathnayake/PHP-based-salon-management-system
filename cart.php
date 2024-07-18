<?php



session_start();



if (!isset($_SESSION['total'])) {
  $_SESSION['total'] = "0.00";
}

if(isset($_POST['add_to_cart'])){
  echo "Form submitted successfully!";

    //if user has already added a products to cart
    if(isset($_SESSION['cart'])){

        $product_array_ids = array_column($_SESSION['cart'],"product_id");   // [ 2,3,4,5,6 ]

        //if product is alread added to cart or not
        if (!in_array($_POST['product_id'], $product_array_ids)){

            //product is already added

            $product_id = $_POST['product_id'];

            $product_array = array(
              'product_id' => $_POST['product_id'],
              'product_name' => $_POST['product_name'],
              'product_price' =>  $_POST['product_price'],
              'product_image' => $_POST['product_image'],
              'product_quantity' =>  $_POST['product_quantity']);

              
                    //session array

                    $_SESSION['cart'][$product_id] = $product_array;

                    //array has another array
                    //product id ekata adala coloums names

                    //  [ 2 => [] , 3 => []]

                }else{

                  //echo '<script>alert("Product was already added to the cart");</script>';
                  //echo '<script>window.location="index.php";</script>';
                 }
            
   

    //if this is the first product
    }else{
       
      $product_id =  $_POST['product_id'];
      $product_name =  $_POST['product_name'];
      $product_price =  $_POST['product_price'];
      $product_image =  $_POST['product_image'];
      $product_quantity =  $_POST['product_quantity'];

      $product_array = array(
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_image' => $product_image,
        'product_quantity' => $product_quantity

      );

      //session array

      $_SESSION['cart'][$product_id] = $product_array;

      //array has another array
      //product id ekata adala coloums names

      //  [ 2 => [] , 3 => []]

    }


    //calculate total

    calculateTotalCart();

    //remove product form cart
}else if(isset($_POST['remove_product'])){



  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);
  

    //calculate total

    calculateTotalCart();

} else if(isset($_POST['edit_quantity'])){

  // Get id and quantity from the form
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];

  // Get the product array from the session
  $product_array = $_SESSION['cart'][$product_id];

  // Update product quantity
  $product_array['product_quantity'] = $product_quantity;

  // Return array back to its place
  $_SESSION['cart'][$product_id] = $product_array;

  
    //calculate total


  // Redirect back to the cart page after updating the quantity



}else{
  
  // header('location: index.php');
  // exit;

}


function calculateTotalCart()
{
    $total = 0;

    foreach ($_SESSION['cart'] as $key => $value) {
        $price = $value['product_price'];
        $quantity = $value['product_quantity'];
        $total += $price * $quantity;
    }

    $_SESSION['total'] = "LKR " . number_format($total, 2); // Format total
}

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="assets/css/style.css"/>

    <style>

  
    </style>

</head>
<body>


 
<?php

include 'header.php';


?>



<!--CART-->

<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2 class="font-weight-bolde">Your Cart</h2>
        <hr>
    </div>

    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
      <!--  $key = product id , $value = array -->
      <?php  
        // Check if session cart is set and it's an array
        if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $key => $value) {
                if(!empty($value)) {
        ?>
        <tr>
            <td>
                <div class="product-info">
                    <img src="<?php echo $value['product_image']; ?>"/>
                    <div>
                        <p><?php echo $value['product_name']; ?></p>
                        <small><span>LKR </span><?php echo number_format($value['product_price'], 2); ?></small>                        
                        <form method="post" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="submit" name="remove_product" class="remove-btn" value="Remove" />
                        </form>
                    </div>
                </div>
            </td>
            <td>
                <!-- Quantity input field with onchange event to update subtotal -->
                <input type="number" id="quantity_input_<?php echo $value['product_id']; ?>" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" min="1" onchange="updateSubtotal(<?php echo $value['product_id']; ?>)">
                <input type="submit" name="edit_product" class="edit-btn" value="Edit" />

              </td>
            </td>
            <td>
                <span>LKR </span>
                <span id="subtotal_<?php echo $value['product_id']; ?>"><?php echo number_format($value['product_quantity'] * $value['product_price'], 2); ?></span>

              </td>
        </tr>
        <?php 
                } 
            } 
        } 
        ?>
    </table>



        







    </table>
<div class="cart-total">
    <table>
        <!-- <tr>
            <td>Subtotal</td>
            <td>Rs.1000.00</td>
        </tr> -->

        <tr>
            <td>Total</td>
            <td id="total"><?php  echo $_SESSION['total'] ; ?></td>
        </tr>


    </table>
</div>

<div class="checkout-container">
  <form method="POST" action="checkout.php">
  <input type="submit" value="Check Out" name="checkout" class="btn checkout-btn"/>
  </form>
</div>





</section>

<!--End of the cart-->



<?php

include 'footer.php';

?>

<!--End of the footer section-->




    <script>

    //Add JavaScript code to toggle the visibility of the quantity input field and edit button when the user clicks on the "Edit" button.
    function toggleEdit(productId) {
        var quantityDisplay = document.getElementById('quantity_display_' + productId);
        var editForm = document.getElementById('edit_form_' + productId);

        if (quantityDisplay.style.display === 'none') {
            quantityDisplay.style.display = 'inline';
            editForm.style.display = 'none';
        } else {
            quantityDisplay.style.display = 'none';
            editForm.style.display = 'inline';
        }
    }
    //End of the toggle the visibility

</script>





      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>

    <!-- Sum of the subtotals  -->

    <script>
  function updateSubtotal(productId) {
    var quantityInput = document.getElementById('quantity_input_' + productId);
    var subtotalElement = document.getElementById('subtotal_' + productId);
    var productPrice = <?php echo json_encode($value['product_price']); ?>; // Get product price from PHP
    var quantity = quantityInput.value;
    var subtotal = productPrice * quantity;
    subtotalElement.textContent = subtotal.toFixed(2); // Update subtotal display

    // Update total by iterating through all products
    var total = 0;
    <?php foreach ($_SESSION['cart'] as $key => $value): ?>
      var subtotalValue<?php echo $key; ?> = parseFloat(document.getElementById('subtotal_<?php echo $key; ?>').textContent);
      total += subtotalValue<?php echo $key; ?>;
    <?php endforeach; ?>
    document.getElementById('total').textContent = "LKR " + total.toFixed(2); // Update total display
    
    // Check if the cart is empty and set total to "Rs.0.00"
    if (total === 0) {
      document.getElementById('total').textContent = "LKR 0.00";
    }
  }

  // Call updateSubtotal for each product on page load to initialize subtotal and total
  window.onload = function() {
    <?php foreach ($_SESSION['cart'] as $key => $value): ?>
      updateSubtotal(<?php echo $key; ?>);
    <?php endforeach; ?>
  }




  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

</script>

