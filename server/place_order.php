<?php
session_start();
include('connection.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['place_order'])) {

    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "Cart is empty. Redirecting to the shop page...";
        echo '<script>setTimeout(function(){ window.location.href = "../shop.php"; }, 3000);</script>';
        exit();
    }


    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_city = $_POST['user_city'];
    $user_address1 = $_POST['user_address1'];
    $user_address2 = $_POST['user_address2'];
    $user_code = $_POST['user_code'];
    $order_cost = $_SESSION['total'];
    $order_status = "on_hold";
    $user_id = $_POST['user_id'];
    $order_date = date('Y-m-d H:i:s');

    // Remove non-numeric characters from the order cost
    $order_cost = preg_replace('/[^0-9.]/', '', $order_cost);

    // Convert the order cost to a float
    $order_cost = floatval($order_cost);


    echo "Order Cost: $order_cost<br>";
    echo "Order Date: $order_date<br>";

    // Insert order details into the orders table
    $stmt = $conn->prepare("INSERT INTO orders(order_cost, order_status, user_id, user_phone, user_city, user_address1, user_address2, user_code, order_date)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param('dsiisssss', $order_cost, $order_status, $user_id, $user_phone, $user_city, $user_address1, $user_address2, $user_code, $order_date);

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $order_id = $stmt->insert_id;
    echo "Order ID: $order_id<br>";


    foreach ($_SESSION['cart'] as $key => $product) {
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_price = $product['product_price'];
        $product_image = $product['product_image'];
        $product_quantity = $product['product_quantity'];

        
        echo "Product ID: $product_id<br>";
        echo "Product Name: $product_name<br>";
        echo "Product Price: $product_price<br>";
        echo "Product Quantity: $product_quantity<br>";
        echo "Order Date: $order_date<br>";

        $stmt1 = $conn->prepare("INSERT INTO order_items(order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt1) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt1->bind_param('iissdiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);

        if (!$stmt1->execute()) {
            die("Execute failed: " . $stmt1->error);
        }
    }

    // cart empty
    unset($_SESSION['cart']);


    echo "Order placed successfully!";
    echo '<br><br><a href="../shop.php" class="btn btn-primary">Back to Home</a>';
} else {

    echo "Form not submitted!";
}
?>
