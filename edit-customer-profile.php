<?php
session_start();
error_reporting(0);
include('server/connection.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if(isset($_POST['submit'])){
    // Retrieve form data
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $user_phone = $_POST['user_phone'];
    
    // Get the editid from URL
    $eid = $_GET['editid'];  
    
    // Prepare and execute the UPDATE query using prepared statements
    $stmt = $conn->prepare("UPDATE user_register SET user_fname=?, user_lname=?, user_phone=? WHERE user_id=?");
    $stmt->bind_param("ssii", $user_fname, $user_lname, $user_phone, $eid);
    
    if($stmt->execute()){
        echo "<script>alert('User Profile Updated Successfully');</script>";
        echo "<script>window.location.href = 'edit-customer.php';</script>"; // Navigate to edit-customer.php
    } else {
        echo "SQL Error: " . $stmt->error;
    }
    $stmt->close();
}

// Retrieve stylist details for editing
$eid = $_GET['editid'] ?? '';
$stmt = $conn->prepare("SELECT * FROM user_register WHERE user_id = ?");
$stmt->bind_param("i", $eid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
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
    <link rel="stylesheet" href="assets/css/home-style.css"/>

    <style>
      
    </style>

</head>
<body>




    <?php include 'header.php'; ?>




    
    <section id="profile" class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Update Your Profile</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="user_fname" value="<?php echo $row['user_fname']; ?>" >
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="user_lname" value="<?php echo $row['user_lname']; ?>" >
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <input type="text" class="form-control" name="user_phone" value="<?php echo $row['user_phone']; ?>" >
                </div>
                <input type="submit" class="btn" name="submit" id="register-btn" value="Update Profile"/>
            </form>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
