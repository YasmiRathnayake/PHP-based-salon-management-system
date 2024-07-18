
<?php
// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$authenticated = isset($_SESSION['stylist_id']); // Check if user is authenticated


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

    <link rel="stylesheet" href="assets/css/home-style.css"/>

    <style>

a.btn-btn-primary {
    text-decoration: none;
    display: inline-block;
    padding: 10px 20px;
    background-color: black; 
    color: white; 
    border-radius: 5px; 
    transition: background-color 0.3s ease-in-out; 
}

a.btn-btn-primary:hover {
    background-color: var(--pink); 
}
  
    </style>

</head>



<body>


<?php

include 'stylist-header.php';


?>




    <!-- Navigation Bar -->
        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <a class="nav-link" href="stylist-dashboard.php">SALON ESTILO</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="stylist-dashboard.php">Home</a>
              </li>
          
              <li class="nav-item ">
                <a class="nav-link " href="#" role="button"  aria-expanded="false">
                  Your Service
                </a>
          
                <li class="nav-item">
                    <a class="nav-link" href="booking_history.php">Appointments</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="edit-stylist.php">Profile</a>
                </li>


                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact</a>
                </li>


                <li class="nav-item">
                  <a href="login.php"><i class="fa-solid fa-user"></i></a>
                </li>





                    <li class="nav-item">
                        <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    </li>



                  </ul>

            
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>


          </div>
        </div>
      </nav> -->
    
<!-- // END OF Nav bar-->




      <!--SERVICES IMAGE-->
<section id="stylist-dashboard">
    <div class="container">
        <div class="container py-lg-8">
            <div class="row bottomhny-grids-sec text-right">
                <div class="col-md-10 bottomhny-1 mx-auto">
                    <div class="bottomhny-gd-ingf text-right"><br><br><br><br><br><br><br><br><br><br><br>
                        <h1 class="hny-title">Welcome Aboard, Talented Stylist </br></br></h1>
                        <h3>We're thrilled to have you join our salon team <br>
                        Get ready to unleash your creativity, make clients feel fabulous, and be part of our vibrant community</h3>
                        <br></br>
                        <h1><span>Together, Let's Create Unforgettable Beauty Experiences </span></h1>
                        <div class="ready-more mt-lg-5 mt-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</section>
<!-- // END OF SERVICES IMAGE-->

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>





