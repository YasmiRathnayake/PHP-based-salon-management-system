<?php
session_start();
$authenticated = isset($_SESSION['admin_id']); // Check if user is authenticated
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
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <a class="nav-link" href="home.php">SALON ESTILO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if($authenticated): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Service</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="add-service.php">Add Service</a></li>
                                <li><a class="dropdown-item" href="manage-service.php">Manage Service</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Product</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="add-product.php">Add Product</a></li>
                                <li><a class="dropdown-item" href="manage-product.php">Manage Product</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Appointment</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="all-appointment.php">All Appointments</a></li>
                                <li><a class="dropdown-item" href="new-appointment.php">New Appointment</a></li>
                                <li><a class="dropdown-item" href="accepted-appointment.php">Accepted Appointment</a></li>
                                <li><a class="dropdown-item" href="rejected-appointment.php">Rejected Appointment</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Stylist</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="all-stylist-request.php">All Stylist</a></li>
                                <li><a class="dropdown-item" href="stylist-request.php">New Stylist Request</a></li>
                                <li><a class="dropdown-item" href="accepted-stylist-request.php">Accepted Stylist Request</a></li>
                                <li><a class="dropdown-item" href="rejected-stylist-request.php">Rejected Stylist Request</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all-customer.php">Customers</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Refunds</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="all-refunds.php">All Refunds</a></li>
                                <li><a class="dropdown-item" href="new-refund.php">New Refund Request</a></li>
                                <li><a class="dropdown-item" href="accepted-refund.php">Accepted Refund Request</a></li>
                                <li><a class="dropdown-item" href="rejected-refund.php">Rejected Refund Request</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Inquiry</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="new-inquiry.php">New Inquiry</a></li>
                                <li><a class="dropdown-item" href="manage-inquiry.php">Manage Inquiry</a></li>
                            </ul>
                        </li>



                                  <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="admin-profile.php">Your Profile</a></li>
                                <li><a class="dropdown-item" href="add-new-admin.php">New Admin</a></li>
                            </ul>
                        </li>
               

                        
                        <li class="nav-item">
                            <a href="home.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin-login.php">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stylist-login.php">Stylist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Customer</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-QBpkwQ3LAC/SRzGDt/gv1W5h1erSu8s7vB+CN6PVyIxUyA3Fr1b7ECbS6fnV5bVd" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-TEoLfNueNujZgZjzSkm+V6Kk7yxGoJ/zP5gWwDlK9ThM6EK1Rt30EUtI5+HaoeWn" crossorigin="anonymous"></script>
</body>
</html>
