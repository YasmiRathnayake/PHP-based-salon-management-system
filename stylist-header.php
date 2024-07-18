<?php
    session_start();
    $authenticated = isset($_SESSION['stylist_id']); // Check if user is authenticated
    $is_stylist = isset($_SESSION['is_stylist']) && $_SESSION['is_stylist'] == true; // Check if user is a stylist
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css"/>

    <style>
    </style>
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
   
                            

          
                            <!-- Show these items only if authenticated customer -->

                            <li class="nav-item">
                                <a class="nav-link" href="stylist-dashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="stylist-request-history.php">Recognition</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="appointments.php">New Appointment</a>
                            </li>
 
                            <li class="nav-item">
                                <a class="nav-link" href="booking_history.php">Done Appointment</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="edit-stylist.php">Profile</a>
                            </li>
      
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
      
                        <li class="nav-item">
                            <a href="home.php"><i class="fa-solid fa-sign-out-alt"></i></a>
                        </li>
                    <?php else: ?>
                        <!-- Show these items only if not authenticated -->

                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link " href="service.php" role="button"  aria-expanded="false">Salon Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php" role="button"  aria-expanded="false">Cosmetic Store</a>
                    </li>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
