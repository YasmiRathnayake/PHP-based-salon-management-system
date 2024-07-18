<?php
session_start();

include('server/connection.php');


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}



error_reporting(E_ALL);
ini_set('display_errors', 1);


$sid = $_GET['sid'] ?? '';

// Fetch service details
$stmt = $conn->prepare("SELECT service_image FROM add_service WHERE service_id = ?");
$stmt->bind_param("i", $sid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if(isset($_POST['submit'])) {
    $sid = $_POST['service_id'];
    
    $target_dir = "uploads/";

    $target_file = $target_dir . basename($_FILES["service_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_extensions = array("jpg", "jpeg", "png");
    
    $check = getimagesize($_FILES["service_image"]["tmp_name"]);
    
    if($check !== false && in_array($imageFileType, $allowed_extensions)) {
        if (move_uploaded_file($_FILES["service_image"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("UPDATE add_service SET service_image=? WHERE service_id=?");
            $stmt->bind_param("si", $target_file, $sid);
            
            if($stmt->execute()) {
                echo "<script>alert('Image updated successfully');</script>";
                echo "<script>window.location.href='edit-service.php?editid=$sid'</script>";
            } else {
                echo "SQL Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    } else {
        echo "<script>alert('Please upload a valid image file (jpg, jpeg, png).');</script>";
    }
}

$sid = $_GET['sid'] ?? '';
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

        #update-image {
            background-image: url('../imgs/register-page-background.jpg');
            width: 100%;
            height: auto;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        #update-image-form {
            width: 40%;
            margin: 0 auto; 
            margin-bottom: 5px;
            text-align: center;
            padding: 20px;
            border-top: 1px solid darkgreen;
            position: relative;
            background: transparent;
            border: 2px solid rgba(255,255,255,.5);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 30px rgba(0,0,0,.5);
            overflow: hidden;
        }

        #update-image-form .form-group {
            margin-bottom: 15px;
        }

        #update-image-form label {
            margin-bottom: 5px;
        }

        #update-image-form input[type="file"] {
            position: relative;
            width: 100%;
            height: 50px;
            border-bottom: 2px solid #162938;
        }

        #update-image-form .btn {
            background-color: lightcoral;
            color: white;
        }





    </style>

</head>
<body>

<?php

include 'admin-header.php';


?>


<!-- UPDATE IMAGE FORM -->

<section id="add-service" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Update Salon Service Image</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">

    <form method="POST" id="update-image-form" enctype="multipart/form-data">
    

    <div class="form-group">
    <label>Service Image</label> </br>
    <img src="<?php echo $row['service_image'] ?? 'default_image_path_here.jpg'; ?>" width="50%" height="50%"> </br> </br>
</div>

        
        <div class="form-group"> 
            <label>Select Image to Update</label>  </br>
            <!-- <input type="file" name="service_image" required> -->
            <input type="file" class="form-control" name="service_image" placeholder="" required style="height: 40px;"/>

    </div>

    <div class="form-group">
        <input type="hidden" name="service_id" value="<?php echo $sid; ?>">
        <input type="submit" name="submit" class="btn btn-default" value="Update Image"/>
    </div>

    
    <div class="form-group">
        <a id="login-url" class="btn" href="">Go Back</a>
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