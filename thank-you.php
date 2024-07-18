<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}



// Check if the session variable exists and is not empty
if (!isset($_SESSION['aptno']) || empty($_SESSION['aptno'])) {
    // If session variable doesn't exist or is empty, redirect to the homepage or another appropriate page
    header('Location: index.php'); // Change 'index.php' to the appropriate URL
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>


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

<div id="thank-you">
    <div id="thank-you-card">
        <h3>Thank You for Your Appointment</h3>
        <hr>
        <p>Your appointment has been successfully booked.</p>
        <p>Your Appointment Number is: <span><?php echo $_SESSION['aptno']; ?></span></p>
        <p>We look forward to seeing you.</p>
    </div>
</div>


<?php

include 'footer.php';


?>








<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>

