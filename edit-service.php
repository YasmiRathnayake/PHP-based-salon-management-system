<?php
session_start();
error_reporting(0);
include('server/connection.php');


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}



if(isset($_POST['submit'])){
    $service_name = $_POST['service_name'];
    $service_description = $_POST['service_description'];
    $service_cost = $_POST['service_cost'];
    $service_category = $_POST['service_category'];  // New field
    
    $eid = $_GET['editid'];  // Get the editid from URL
    
    $stmt = $conn->prepare("UPDATE add_service SET service_name=?, service_category=?, service_description=?, service_cost=? WHERE service_id=?");
    $stmt->bind_param("sssii", $service_name, $service_category, $service_description, $service_cost, $eid);
    
    if($stmt->execute()){
        echo "<script>alert('Service Updated Successfully');</script>";
        echo "<script>window.location.href = 'manage-service.php';</script>";
    } else {
        echo "SQL Error: " . $stmt->error;
    }
    $stmt->close();
}


$cid = $_GET['editid'] ?? '';
$stmt = $conn->prepare("SELECT * FROM add_service WHERE service_id = ?");
$stmt->bind_param("i", $cid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();  // Fetch a single row since we are editing one service
$stmt->close();
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Update Services</title>
    <!-- Bootstrap Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel='stylesheet' type='text/css' />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<style>

#update-service {
            background-image: url('../imgs/register-page-background.jpg');
            width: 100%;
            height: auto;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        #edit-service-form {
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

        #edit-service-form .form-group {
            margin-bottom: 15px; /* Add margin bottom between form groups */
        }

        #edit-service-form label {
            margin-bottom: 5px; /* Add margin bottom between label and input */
            font-weight: bold;
            
        }

        #edit-service-form input{
            width: 100%;
            height: 50px;
            border-bottom: 2px solid #162938;
        }
        #edit-service-form textarea {
            width: 100%;
            height: 100px;
            border-bottom: 2px solid #162938;
        }

        #edit-service-form .btn {
            background-color: lightcoral;
            color: white;
        }
        
        #edit-service-form  .btn-update-img {
            background-color: darkred;
            color: white;
        }



</style>




</head>
<body>
    <?php include 'admin-header.php'; ?>

    <!-- Update Service Form -->
    <section id="update-service" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Update Salon Service</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        <form method="POST" id="edit-service-form">
        
        <div class="form-group">
            <label>Service Name</label>
            <input type="text" class="form-control" name="service_name" placeholder="" value="<?php echo $row['service_name']; ?>" required>
        </div>

        <div class="form-group">
            <label>Service Category</label>
            <select class="form-control" name="service_category" required>
                <option value="" disabled>Select Service Category</option>
                <option value="hair" <?php echo ($row['service_category'] == 'hair') ? 'selected' : ''; ?>>Hair</option>
                <option value="skin" <?php echo ($row['service_category'] == 'skin') ? 'selected' : ''; ?>>Skin</option>
                <option value="body" <?php echo ($row['service_category'] == 'body') ? 'selected' : ''; ?>>Body</option>
                <option value="nail" <?php echo ($row['service_category'] == 'nail') ? 'selected' : ''; ?>>Nail</option>
            </select>
        </div>


        <div class="form-group">
            <label>Service Description</label>
            <textarea class="form-control" name="service_description" required><?php echo $row['service_description']; ?></textarea>
        </div>


        <div class="form-group">
            <label>Service Price</label>
            <input type="text" class="form-control" name="service_cost" placeholder="" value="<?php echo $row['service_cost']; ?>" required>
        </div>


        <div class="form-group"> 
            <label>Service Image</label>  </br>
            <img src="<?php echo $row['service_image']; ?>" width="50%" height="50%"> </br> </br>
            <a href="update-image.php?sid=<?php echo $row['service_id'];?>" class="btn btn-update-img">Change Image</a> 
        </div>


            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-default" value="Update Service"/>
            </div>
        </form>



    </div>
</section>

    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

        <!-- Footer -->
        <?php include 'footer.php';?>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>