<?php
include ('server/connection.php');

$email_error = ''; // Initialize email error message

if(isset($_POST['register'])){
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_password = $_POST['user_password'];

    // Check password length
    if(strlen($user_password) < 6) {
        header('location: register.php?error=Password must be at least 6 characters long');
        exit();
    }

    // Check if the email already exists
    $stmt1 = $conn->prepare("SELECT COUNT(*) FROM user_register WHERE user_email=?");
    $stmt1->bind_param('s', $user_email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->fetch();
    $stmt1->close(); // Close the result set

    if($num_rows != 0){
        // Email already exists, display alert and redirect
        echo "<script>alert('User with this email already exists'); window.location.href = 'register.php';</script>";
        exit();
    } else {
        // Create a new user
        $stmt = $conn->prepare("INSERT INTO user_register(user_fname, user_lname, user_email, user_phone, user_password)
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssis', $user_fname, $user_lname, $user_email, $user_phone, md5($user_password));
        $stmt->execute();
        $stmt->close(); // Close the prepared statement after execution

        // Start a session and set user_id session variable
        session_start();
        $_SESSION['user_id'] = $user_email;

        // Redirect the user to the home page
        header('location: home.php');
        exit();
    }
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="assets/css/style.css"/>

    <style>

        

  
    </style>

</head>
<body>

<?php

include 'header.php';


?>

<!--REGISTRATION FORM-->
<section id="register" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Register</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
    <form id="register-form" method="POST" action="register.php" onsubmit="return validateForm()">
    <div class="form-group">
        <label>First Name</label>
        <input type="text" class="form-control" name="user_fname" placeholder="First Name" required/>
    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input type="text" class="form-control" name="user_lname" placeholder="Last Name" required/>
    </div>

    <div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Email" required/>
                    <!-- Display email error message -->
                    <p id="email-error" style="color: red;"><?php echo $email_error; ?></p>
</div>


    <div class="form-group">
        <label>Contact Number</label>
        <input type="text" class="form-control" name="user_phone" minlength="10" maxlength="10" pattern="07\d{8}" title="Please enter a 10-digit phone number starting with 07" placeholder="Contact Number" required/>
        <div id="phone-error" style="display: none; color: red;">Phone number must be 10 digits and start with 07</div>  
    </div>  
    

    <div class="form-group">
        <label>Password</label>
        <input type="password" id="user_password" class="form-control" name="user_password" placeholder="Password" minlength="6" required/>
    </div>

    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" id="user_confirmPassword" class="form-control" name="user_confirmPassword" placeholder="Confirm Password" minlength="6" required/>
        <div id="password-error" style="display: none; color: red;">Passwords do not match !</div>
    </div>

    <div class="form-group">
        <input type="submit" class="btn" name="register" id="register-btn" value="Register"/>
    </div>

    <div class="form-group">
        <a id="login-url" class="btn" href="login.php">Do you have an account? Login here.</a>
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

// check the password and the comfirm password is same or not 

document.getElementById("user_confirmPassword").addEventListener("input", function(event) {
            var password = document.getElementById("user_password").value;
            var confirmPassword = event.target.value;

            if (password !== confirmPassword) {
                document.getElementById("password-error").style.display = "block";
            } else {
                document.getElementById("password-error").style.display = "none";
            }
        });


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