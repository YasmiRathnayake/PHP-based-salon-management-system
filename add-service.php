<?php

session_start();
error_reporting(0);


include ('server/connection.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}


if(isset($_POST['submit'])){
    $service_name = $_POST['service_name'];
    $service_description = $_POST['service_description'];
    $service_cost = $_POST['service_cost'];
    $service_category = $_POST['service_category']; // New field

    // File Upload Handling
    $service_image_name = $_FILES["service_image"]["name"];
    $service_image_tmp = $_FILES["service_image"]["tmp_name"];
    $upload_directory = "uploads/";
    $service_image_path = $upload_directory . $service_image_name;

    // Move uploaded file to uploads directory
    if(move_uploaded_file($service_image_tmp, $service_image_path)){
        $stmt = $conn->prepare("INSERT INTO add_service(service_name, service_description, service_cost, service_image, service_category) 
                                 VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $service_name, $service_description, $service_cost, $service_image_path, $service_category);

        if($stmt->execute()){
            echo "<script>alert('Service added successfully');</script>";
            echo "<script>window.location.href = 'add-service.php';</script>";
        } else {
            echo "SQL Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "File upload failed. Please check the uploads directory permissions.";
    }
}
?>

<!-- Your HTML form here -->







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css"/>

    <style>

        
#service-description {
    width: 100%; 
    height: 150px; 
    resize: both; /* Allows the textarea to be resizable */

}



    </style>

</head>
<body>

<?php

include 'admin-header.php';


?>


<!--REGISTRATION FORM-->
<section id="add-service" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Add New Salon Service</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        



    <form method="POST" action="add-service.php" id="add-service-form" enctype="multipart/form-data">
            <div class="form-group">
                <label>Service Name</label>
                <input type="text" class="form-control"  name="service_name" placeholder="" required/>
            </div>

            <div class="form-group">
                    <label>Service Category</label>
                    <select class="form-control" name="service_category" required>
                        <option value="" disabled selected>Select Service Category</option>
                        <option value="hair">Hair</option>
                        <option value="skin">Skin</option>
                        <option value="body">Body</option>
                        <option value="nail">Nail</option>
                    </select>
            </div>


            <div class="form-group">
                <label>Service Description </label>
                <textarea type="text" class="form-control"  name="service_description" placeholder="" required></textarea>
            </div>

            <div class="form-group">
                <label>Service Price</label>
                <input type="text" class="form-control"  name="service_cost" placeholder="" required/>
            </div>

            <div class="form-group">
                <label>Service Image</label>
                <input type="file" class="form-control" name="service_image" placeholder="" required style="height: 40px;"/>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" class="btn" id="add-service-btn" value="Add Service"/>
            </div>

            <div class="form-group">
                <a id="login-url" class="btn" href="">Go Back</a>
            </div>
        </form>
    </div>
</section>











  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-QBpkwQ3LAC/SRzGDt/gv1W5h1erSu8s7vB+CN6PVyIxUyA3Fr1b7ECbS6fnV5bVd" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-TEoLfNueNujZgZjzSkm+V6Kk7yxGoJ/zP5gWwDlK9ThM6EK1Rt30EUtI5+HaoeWn" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>