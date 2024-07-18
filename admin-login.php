<?php
session_start();
include('server/connection.php');

if(isset($_POST['admin-login'])) {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password']; 

    $stmt = $conn->prepare("SELECT admin_id, admin_email, admin_password FROM admin WHERE admin_email=? LIMIT 1");

    $stmt->bind_param('s', $admin_email);

    if($stmt->execute()) {
        $stmt->store_result();

        if($stmt->num_rows() == 1) {
            $stmt->bind_result($admin_id, $admin_email, $hashed_password);
            $stmt->fetch();

            if(password_verify($admin_password, $hashed_password)) {
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['admin_email'] = $admin_email;
                $_SESSION['logged_in'] = true;

                echo "<script> window.location.href = 'dashboard.php';</script>";
                exit();
            } else {
                echo "<script>alert('Your password is incorrect'); window.location.href = 'admin-login.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Your email is not registered'); window.location.href = 'admin-login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Something went wrong'); window.location.href = 'admin-login.php';</script>";
        exit();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>


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



<!-- ADMIN LOGIN FORM -->

<section id="login" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Admin Login</h2>
    </div>

    <div class="mx-auto container">
        <form id="login-form" method="POST" action="admin-login.php">
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="admin_email" placeholder="Email" required/>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="admin_password" placeholder="Password" required/>
            </div>

            <div class="form-group">
                <input type="submit" name="admin-login" class="btn" id="login-btn" value="Login to Dashboard"/>
            </div>

            <div class="form-group">
                <a id="register-url" class="btn" href="home.php">Back to Home</a>
            </div>
        </form>
    </div>
</section>

<?php
include 'footer.php';
?>

<!-- ... -->
</body>
</html>







<?php

include 'footer.php';


?>
  
  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>