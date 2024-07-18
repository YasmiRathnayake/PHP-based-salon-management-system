
<?php
include('server/connection.php');


session_start();
$authenticated = isset($_SESSION['user_id']); // Check if user is authenticated



        $query = "SELECT * FROM add_service";
        $result = $conn->query($query);
        $services = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $services[] = $row;
            }
        }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service</title>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="assets/css/style.css"/>
    
    <link rel="stylesheet" href="assets/css/home-style.css"/>


<style>

/* Remove underline and style the anchor tag */
a.btn-btn-primary {
    text-decoration: none; /* Remove underline */
    display: inline-block;
    padding: 10px 20px;
    background-color: black; /* Button background color */
    color: white; /* Button text color */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s ease-in-out; /* Smooth transition for background color */
}

a.btn-btn-primary:hover {
    background-color: var(--pink); /* Darker background color on hover */
}



</style>




</head>
<body>
   

<?php

include 'header.php';


?>
    
<!--SERVICES IMAGE-->
<section id="home-service">
    <div class="container">
        <div class="container py-lg-8">
            <div class="row bottomhny-grids-sec text-right">
                <div class="col-md-10 bottomhny-1 mx-auto">
                    <div class="bottomhny-gd-ingf text-right">
                        <h1 class="hny-title">Reveal Your Natural Radiance <br> and Feel Renewed</br>
                        <br><span>Discover Our Spectrum of Services</span></h1>
                        <div class="ready-more mt-lg-5 mt-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</section>
<!-- // END OF SERVICES IMAGE-->

<!-- SALON SERVICES INTRO -->
<div class="w3l-bottom-grids py-5" id="about">
  <div class="container py-lg-5">
    <div class="row bottomhny-grids-sec text-center">
      <div class="col-md-10 bottomhny-1 mx-auto">
        <div class="bottomhny-gd-ingf">
          <h6 class="sub-title">OUR SALON SERVICES</h6>
          <h1 class="hny-title">Welcome to Home of Beauty,<br>Relaxation and Respite</h1>
          <p class="mt-3">Discover a sanctuary of beauty and relaxation at Home of Beauty. Our salon offers a curated selection of services designed to enhance your natural allure and rejuvenate your spirit. From precision haircuts and transformative hair color to revitalizing facials and pampering eyelash extensions, our expert team is dedicated to delivering personalized, exceptional results. Experience the blend of luxury and comfort at our salon and embrace your best self with us.</p>
          <div class="ready-more mt-lg-5 mt-4">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- // END OF SALON SERVICES INTRO  -->


<!-- SALON SERVICES -->
</div>
			<div class="row w3-services-grids">

				<?php foreach ($services as $service): ?>
   					<div class="col-lg-4 col-md-6 luxe-grid">
        			<div class="luxe-grid-info">
						<img src="<?php echo $service['service_image']; ?>" class="img-fuild" alt="<?php echo $service['service_name']; ?>">
						<h4 class="cause-title"><?php echo $service['service_name']; ?></h4>
						<p class="card-text mb-0"><?php echo $service['service_description']; ?></p></br>
						<h4 class="cause-title"><span>LKR </span><?php echo $service['service_cost']; ?></h4>
                        

                <!-- Conditionally enable/disable button -->
                <?php if($authenticated): ?>
                    <a class="btn-btn-primary px-4 py-2 fs-5 mt-3" href="book-appointment.php?service_name=<?php echo urlencode($service['service_name']); ?>&service_category=<?php echo urlencode($service['service_category']); ?>">Make An Appointment</a>
                <?php else: ?>
                    <button class="btn-btn-primary px-4 py-2 fs-5 mt-3" disabled>Make An Appointment</button>
                    <p class="error-message">Please <a href="login.php">login</a> or <a href="register.php">register</a> to get the service.</p>
                <?php endif; ?>



       				</div>
  					</div>
				<?php endforeach; ?>

				
	</div>
<!-- END OF SALON SERVICES -->

<?php

include 'footer.php';


?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>