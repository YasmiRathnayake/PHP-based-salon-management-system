<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: login.php");
    exit();
}

include('server/connection.php');

$user_email = $_SESSION['user_email'];


$stmt = $conn->prepare("SELECT * FROM user_register WHERE user_email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "User data not found!";
    exit();
}
$stmt->close();
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
        

        .centered-heading {
            text-align: center;
        }

  
    </style>

</head>
<body>



<?php

  include 'header.php';
  

?>


<section id="checkout" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Check Out</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">

    <!-- action="server/place_order.php" -------
    
    why using server? bcz the place_order.php is inside of the server and the checkout.php is outside of the server -->

    <form id="checkout-form" action="server/place_order.php" method="POST">
    
    <div class="form-group checkout-small-element">
                <label>User ID</label>
                <input type="text" class="form-control" name="user_id" value="<?php echo $row['user_id']; ?>" readonly>
            </div>
            <div class="form-group checkout-small-element">
                <label>First Name</label>
                <input type="text" class="form-control" name="user_fname" value="<?php echo $row['user_fname']; ?>" readonly>
            </div>

            <div class="form-group checkout-small-element">
                <label>Last Name</label>
                <input type="text" class="form-control" name="user_lname" value="<?php echo $row['user_lname']; ?>" readonly>
            </div>

            <div class="form-group checkout-small-element">
                <label>Email</label>
                <input type="text" class="form-control" name="user_email" value="<?php echo $row['user_email']; ?>" readonly>
            </div>

            <div class="form-group checkout-small-element">
                <label>Phone</label>
                <input type="text" class="form-control" name="user_phone" value="<?php echo $row['user_phone']; ?>" readonly>
            </div>




            <hr/>

            <h3 class="centered-heading">Shipping Details</h3></br>



            <div class="form-group checkout-small-element">
                <label>Address Line 1</label>
                <input type="text" class="form-control" id="checkout-city" name="user_address1" placeholder="Address Line 1" required>
            </div>

            <div class="form-group checkout-small-element">
                <label>Address Line 2</label>
                <input type="text" class="form-control" id="checkout-city" name="user_address2" placeholder="Address Line 2" />
            </div>

            <div class="form-group checkout-small-element">
                <label>City</label>
                <input type="text" class="form-control" id="checkout-city" name="user_city" placeholder="City" required/>
            </div>



            <div class="form-group checkout-small-element">
                <label>Zip / Postal Code</label>
                <input type="text" class="form-control" id="checkout-city" name="user_code" placeholder="Zip / Postal Code" required/>
            </div>


            <div class="form-group checkout-btn-container">
                <p>Total Amount :  <?php echo $_SESSION['total']?></p>
                <input type="submit" name="place_order" class="btn" id="checkout-btn" value="Place Order"/>
            </div>

            
        </form>
    </div>
</section>







<?php

  include 'footer.php';
  

?>

  
  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>