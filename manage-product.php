<?php
session_start();
error_reporting(0);
include('server/connection.php');


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}




if (isset($_GET['delid'])) {
    $sid = $_GET['delid'];
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id= ?");
    $stmt->bind_param("i", $sid);
    
    if ($stmt->execute()) {
        echo "<script>alert('Data Deleted');</script>";
        echo "<script>window.location.href='manage-product.php'</script>";
    } else {
        echo "SQL Error: " . $stmt->error;
    }
    $stmt->close();
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
    <link rel="stylesheet" href="assets/css/style.css"/>


    <style>



    </style>

</head> 

<body>
    <div class="main-content">

    <?php

include 'admin-header.php';


?>


   

<section id="manage-service">

<div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Manage Product</h3>
                    <div class="table-responsive bs-example widget-shadow">
                        <h4>Update Product:</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Product Price (LKR)</th>
                                    <th>Creation Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        <tbody>
                                <?php
                                $query = "SELECT product_id, product_name, product_price, product_createDate FROM products";
                                $result = $conn->query($query);
                                $cnt = 1;
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $cnt;?></th>
                                    
                                    <td><?php echo $row['product_name'];?></td>
                                    <td><?php echo $row['product_price'];?></td>
                                    <td><?php echo $row['product_createDate'];?></td>
                                    <td>
                                        <a href="edit-product.php?editid=<?php echo $row['product_id']; ?>" class="btn btn-primary">Edit</a>
                                        <a href="manage-product.php?delid=<?php echo $row['product_id']; ?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                                    </td>
                                </tr>
                                <?php 
                                $cnt++;
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



</section>
      



<script src="js/classie.js"></script>
<script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };

    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
</script>
  



  <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

