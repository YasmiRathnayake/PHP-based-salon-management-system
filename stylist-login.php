<?php
session_start();
include('server/connection.php');



if(isset($_POST['stylist-login'])) {
    $stylist_email = $_POST['stylist_email'];
    $stylist_password = $_POST['stylist_password']; 

    $stmt = $conn->prepare("SELECT stylist_id, stylist_email, stylist_password, stylist_status FROM stylist WHERE stylist_email=? LIMIT 1");

    $stmt->bind_param('s', $stylist_email);

    if($stmt->execute()) {
        $stmt->store_result();

        if($stmt->num_rows() == 1) {
            $stmt->bind_result($stylist_id, $stylist_email, $hashed_password, $stylist_status);
            $stmt->fetch();

            if(password_verify($stylist_password, $hashed_password)) {
                if($stylist_status == "Accepted") {
                    // Store session variables and redirect
                    $_SESSION['stylist_id'] = $stylist_id;
                    $_SESSION['stylist_email'] = $stylist_email;
                    $_SESSION['stylist_status'] = $stylist_status;
                    $_SESSION['logged_in'] = true;

                    echo "<script>window.location.href = 'stylist-dashboard.php';</script>";
                    exit();
                } elseif($stylist_status == "Pending") {
                    echo "<script>alert('Your request is still pending.');</script>";
                    echo "<script>window.location.href = 'stylist-login.php';</script>";
                    exit();
                } elseif($stylist_status == "Rejected") {
                    echo "<script>alert('Your request has been rejected.');</script>";
                    echo "<script>window.location.href = 'stylist-login.php';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Your password is incorrect');</script>";
                echo "<script>window.location.href = 'stylist-login.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Your email is not registered');</script>";
            echo "<script>window.location.href = 'stylist-login.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Something went wrong');</script>";
        echo "<script>window.location.href = 'stylist-login.php';</script>";
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

<section id="stylist-login" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Stylist Login</h2>
    </div>

    <div class="mx-auto container">
        <form id="login-form" method="POST" action="stylist-login.php">
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="stylist_email" placeholder="Email" required/>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="stylist_password" placeholder="Password" required/>
            </div>

            <div class="form-group">
                <input type="submit" name="stylist-login" class="btn" id="login-btn" value="Login to Dashboard"/>
            </div>

            <div class="form-group">
                <a id="register-url" class="btn" href="stylist-registration.php">Don't have an account? Register here.</a>
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