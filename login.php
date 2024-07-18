<?php
session_start();
include ('server/connection.php');

if(isset($_POST['login_btn'])) {
    $user_email = $_POST['email']; // Corrected from 'user_email' to 'email'
    $user_password = $_POST['password']; // Corrected from 'user_password' to 'password'
    
    $stmt = $conn->prepare("SELECT user_id, user_email, user_password FROM user_register WHERE user_email=? LIMIT 1"); // Corrected 'user_emial' to 'user_email'

    $stmt->bind_param('s', $user_email);

    if($stmt->execute()) {
        $stmt->store_result();

        if($stmt->num_rows() == 1) {
            $stmt->bind_result($user_id, $user_email, $hashed_password);
            $stmt->fetch();

            // Verify password using md5()
            if(md5($user_password) === $hashed_password) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['logged_in'] = true;
                

                echo "<script>alert('Login successfully'); window.location.href = 'home.php';</script>";
                exit();
            } else {
                echo "<script>alert('Your password is incorrect'); window.location.href = 'login.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Your email is not registered'); window.location.href = 'login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Something went wrong'); window.location.href = 'login.php';</script>";
        exit();
    }
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>


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

<!--LOGIN-->
<section id="login-customer" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Customer Login</h2>
    </div>

    <div class="mx-auto container">
    <form id="login-form" method="POST" action="login.php">
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required/>
        <p style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required/>
    </div>

    <div class="form-group">
        <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
    </div>

    <div class="form-group">
        <a id="register-url" class="btn" href="register.php">Don't have an account? Register here.</a>
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