




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="assets/css/style.css"/>
    <link rel="stylesheet" href="assets/css/home-style.css"/>

    <style>
      
    </style>

</head>
<body>


 
<?php

include 'header.php';


?>




 
    <!--Image slider-->

    
    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active"></li>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1"></li>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2"></li>
        </div>
    
        <div class="carousel-inner">
            <div class="carousel-item active c-item">
                <img class="d-block w-100 c-img" src="assets/imgs/smiling-lady-with-flowers-head.jpg">
                
                <div class="carousel-caption top-0 mt-4 d-none d-md-block">
                  <p class="mt-5 fs-3 ">Welcome to Salon Estilo</p>
                  <h1 class="display-1 fw-bolder text-capitalize">Are You Ready for a New & Better You?</h1>

                  <?php if($authenticated): ?>
                    <button class="btn-btn-primary px-4 py-2 fs-5 mt-5" disabled>Login Now</button>
                <?php else: ?>
                 
                    <a href="login.php"><button class="btn-btn-primary px-4 py-2 fs-5 mt-5" data-bs-toggle="modal" data-bs-target="#booking-modal">Login Now</button></a> 

                <?php endif; ?>

                </div>
            
             </div>
            <div class="carousel-item c-item">
                <img class="d-block w-100 c-img" src="assets/imgs/banner2.jpg" alt="Second slide">
                <div class="carousel-caption top-0 mt-4 d-none d-md-block">
                  <p class="mt-5 fs-3 ">Enhance Your Natural Beauty and Leave You Feeling Refreshed</p>
                  <h1 class="display-1 fw-bolder text-capitalize">Explore Our Range of Services </h1>
                  <a href="service.php"><button class="btn-btn-primary px-4 py-2 fs-5 mt-5" data-bs-toggle="modal" data-bs-target="#booking-modal">Make an Appointment</button></a>
                </div>
              </div>

            <div class="carousel-item c-item">
                <img class="d-block w-100 c-img" src="assets/imgs/banner3.jpg" alt="Third slide">
                <div class="carousel-caption top-0 mt-4 d-none d-md-block">
                  <p class="mt-5 fs-3 ">Shop Our Exclusive Cosmetics Online and Enjoy Salon-Quality Products </p>
                  <h1 class="display-1 fw-bolder text-capitalize">Be Natural and Glowing with Estilo</h1>
                  <a href="index.php"><button class="btn-btn-primary px-4 py-2 fs-5 mt-5" data-bs-toggle="modal" data-bs-target="#booking-modal">Shop Now</button></a>
                </div>
              </div>
        </div>
        <button id="carousel-previous" class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button id="carousel-next" class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
    </div>
    
 
 




<!-- Home page About us section -->
<div class="w3l-bottom-grids py-5" id="about">
  <div class="container py-lg-5">
    <div class="row bottomhny-grids-sec text-center">
      <div class="col-md-10 bottomhny-1 mx-auto">
        <div class="bottomhny-gd-ingf">
          <h6 class="sub-title">About Us</h6>
          <h1 class="hny-title">Welcome to Home of Beauty,<br>Relaxation and Respite</h1>
          <p class="mt-3">We are dedicated to providing an exceptional experience that goes beyond the ordinary salon visit.
             Our team of skilled professionals is committed to helping you look and feel your best, offering a range of services tailored to your unique needs. 
             From luxurious treatments to personalized care, we strive to create an atmosphere of tranquility where you can escape the stresses of everyday life and indulge in self-care. 
             Step into our oasis and embark on a journey to rediscover your natural radiance and inner peace.</p>
          <div class="ready-more mt-lg-5 mt-4">
            <button class="btn-btn-primary px-4 py-2 fs-5 mt-5" href="#">Read More</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- // Home page About us section -->







  <hr class="hr-under-aboutus"/>

<!--BANNER-->
<section id="banner-1" class="my-5 py-5">
  <div class="container">
    <h4>Experience Our Cutting-Edge Salon Services !</h4>
    <h1>Indulge In our Latest Salon Services Enhanced With <span>State-Of-The-Art Technology</span> 
    <br>Step Into The Future Of Beauty Today </h1>
  </div>
</section>



    



	<!-- Two services and picture-->
	<section class="w3l-index2">
		<div class="row abouthy-img-grids no-gutters">
			<div class="col-md-6 img-one">
				<img src="assets/imgs/makeup-services.jpg" alt=" " class="img-fluid">
			</div>
			<div class="col-md-6 img-one content-mid py-md-0 py-5">
				<div class="info">
					<h3 class="hny-title two">
					Revitalize Your Hair and Skin with Our Premium Treatments
					</h3>
					<p class="mt-3 mb-5 pr-lg-4">At our salon, we specialize in bringing out the best in your hair and skin.
             Our expert stylists and aestheticians use cutting-edge techniques and top-quality products to ensure your treatments are both effective and luxurious.
              Whether you're looking for a nourishing hair treatment to add shine and strength, or a rejuvenating skin care regimen to achieve a radiant complexion, we've got you covered.
               Experience the ultimate in hair and skin care with our customized treatments designed to meet your unique needs.
					</p>
					<div class="ready-more">
            
          <a href="service.php"><button class="btn-btn-primary px-4 py-2 fs-5 mt-5" >Get Service</button></a>
					
					</div>
				</div>
			</div>
			<div class="col-md-6 img-info content-mid py-md-0 py-5">
				<div class="info">
					<h3 class="hny-title two">
					Indulge in Our Exceptional Body and Nail Care Treatments
					</h3>
					<p class="mt-3 mb-5 pr-lg-4">Transform your body and nails with our comprehensive care treatments. Our skilled professionals are dedicated to providing top-notch services that leave you feeling refreshed and pampered.
             From invigorating body scrubs and massages that rejuvenate your skin, to meticulous manicures and pedicures that ensure your nails are flawless, we use premium products and innovative techniques to deliver outstanding results. 
            Treat yourself to the ultimate relaxation and beauty experience with our personalized body and nail care treatments.
					</p>
					<div class="ready-more">
          <a href="service.php"><button class="btn-btn-primary px-4 py-2 fs-5 mt-5" >Get Service</button></a>
					</div>
				</div>
			</div>
			<div class="col-md-6 img-one">
				<img src="assets/imgs/young-woman-doing-her-morning-routine.jpg" alt=" " class="img-fluid">
			</div>
		</div>
	</section>





  <hr class="hr-under-aboutus"/>

<!--BANNER-->
<section id="banner-2" class="my-5 py-5">
  <div class="container">
    <h4>Discover Our Premium Cosmetic Collection !</h4>
    <h1>Experience Our <span>Exceptional Cosmetics</span> <br> Define Your Beauty Identity</h1>
    <br>Enhance Your Routine And Natural Beauty</h1>
  </div>
</section>


	<!-- Two store items and picture-->
	<section class="w3l-index2">
		<div class="row abouthy-img-grids no-gutters">
			<div class="col-md-6 img-one">
				<img src="assets/imgs/small-plant-near-various-cosmetics-bottles.jpg" alt=" " class="img-fluid">
			</div>
			<div class="col-md-6 img-one content-mid py-md-0 py-5">
				<div class="info">
					<h3 class="hny-title two">
          Elevate Your Beauty Routine with Our Hair and Skincare Products
					</h3>
					<p class="mt-3 mb-5 pr-lg-4">Discover our curated selection of hair and skincare products, crafted to bring out the best in your natural beauty.
             Our online store features a variety of premium shampoos, conditioners, and treatments that revitalize and strengthen your hair, leaving it healthy and lustrous. 
             Complementing our haircare range, we offer top-quality skincare products, including cleansers, moisturizers, and serums designed to nourish, hydrate, and rejuvenate your skin. 
             Experience the transformative power of our carefully selected cosmetics and elevate your beauty routine to new heights. 
            Shop now for glowing skin and beautiful hair.
					</p>
					<div class="ready-more">
          <a href="index.php"><button class="btn-btn-primary px-4 py-2 fs-5 mt-5" >Shop Now</button></a>
					</div>
				</div>
			</div>
			<div class="col-md-6 img-info content-mid py-md-0 py-5">
				<div class="info">
					<h3 class="hny-title two">
          Discover Premium Body and Nail Care Products in Our Online Store
					</h3>
					<p class="mt-3 mb-5 pr-lg-4">Explore our exclusive collection of body and nail care products, designed to pamper and enhance your natural beauty.
             Our online store offers a range of high-quality cosmetics, from luxurious body lotions and scrubs that nourish and rejuvenate your skin, to top-tier nail polishes and treatments that ensure your nails look flawless. 
             Carefully selected for their effectiveness and quality, our products help you achieve spa-like results in the comfort of your home.
             Shop now and treat yourself to the ultimate in body and nail care.
					</p>
					<div class="ready-more">
          <a href="index.php"><button class="btn-btn-primary px-4 py-2 fs-5 mt-5" >Shop Now</button></a>
					</div>
				</div>
			</div>
			<div class="col-md-6 img-one">
				<img src="assets/imgs/professional-makeup-tools-colored-background.jpg" alt=" " class="img-fluid">
			</div>
		</div>
	</section>

















      


 
<?php

include 'footer.php';


?>
  
  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>