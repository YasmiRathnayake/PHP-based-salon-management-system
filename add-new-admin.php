<?php
session_start();
error_reporting(0);
include('server/connection.php');


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}




if(isset($_POST['submit'])){
    $admin_name = $_POST['admin_name'];
    $admin_address = $_POST['admin_address'];
    $admin_gender = $_POST['admin_gender'];
    $admin_contact = $_POST['admin_contact'];
    $admin_email = $_POST['admin_email'];
    $admin_password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT); // Hash the password

    $stmt = $conn->prepare("INSERT INTO admin (admin_name, admin_address, admin_gender, admin_contact, admin_email, admin_password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $admin_name, $admin_address, $admin_gender, $admin_contact, $admin_email, $admin_password);

    if($stmt->execute()){
        echo "<script>alert('Admin Details inserted successfully');</script>";
        echo "<script>window.location.href = 'admin-profile.php';</script>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>

        

  
    </style>

</head>
<body>

<?php

include 'admin-header.php';


?>

<!--ADMIN PROFILE UPDATE FORM-->

<section id="admin-profile" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Add New Admin</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">

    <form id="register-form" method="POST" action="admin-profile.php" onsubmit="return validateForm()">
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="admin_name" placeholder="" value="<?php echo $admin['admin_name']; ?>" required/>
    </div>

    <div class="form-group">
        <label>Address</label>
        <input type="text" class="form-control" name="admin_address" placeholder="" value="<?php echo $admin['admin_address']; ?>" required/>
    </div>

    <div class="form-group">
        <label>Gender</label>
        <select class="form-control" name="admin_gender" required>
            <option value="" disabled selected>Select your Gender</option>
            <option value="male" <?php echo ($admin['admin_gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
            <option value="female" <?php echo ($admin['admin_gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
        </select>
    </div>

    <div class="form-group">
        <label>Contact Number</label>
        <input type="text" class="form-control" name="admin_contact" value="<?php echo $admin['admin_contact']; ?>" minlength="10" maxlength="10" pattern="07\d{8}" title="Please enter a 10-digit phone number starting with 07" placeholder="" required/>
        <div id="phone-error" style="display: none; color: red;">Phone number must be 10 digits and start with 07</div>  
    </div>  

    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="admin_email" value="<?php echo $admin['admin_email']; ?>" placeholder="" required/>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" id="admin_password" class="form-control" name="admin_password" placeholder="" minlength="6" required/>
    </div>

    <div class="form-group">
        <input type="submit" class="btn" name="submit" id="register-btn" value="Update"/>
    </div>

    <div class="form-group">
        <a id="login-url" class="btn" href="login.php">Go Back</a>
    </div>
</form>

    </div>
</section>



<?php

include 'footer.php';


?>

<!-- <script>
        function validateForm() {
            var password = document.getElementById("user_password").value;
            var confirmPassword = document.getElementById("user_confirmPassword").value;

            if (password !== confirmPassword) {
                document.getElementById("password-error").style.display = "block";
                return false; // Prevent form submission
            }
            return true;
        }
    </script> -->

<script>

// validate the phone number 

    document.getElementById("user_phone").addEventListener("input", function(event) {
        var phoneNumber = event.target.value;
        var phoneNumberError = document.getElementById("phone-error");

        if (!/^07\d{8}$/.test(phoneNumber)) {
            phoneNumberError.style.display = "block";
        } else {
            phoneNumberError.style.display = "none";
        }
    });




</script>






      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>