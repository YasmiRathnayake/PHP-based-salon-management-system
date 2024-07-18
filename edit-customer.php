<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: login.php");
    exit();
}


include('server/connection.php');

// Fetch user details using their email from the session
$user_email = $_SESSION['user_email'];

// Prepare and execute SQL query to fetch user data
$stmt = $conn->prepare("SELECT * FROM user_register WHERE user_email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user data is fetched successfully
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "User data not found!";
    exit();
}
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
    

<?php 
            include 'header.php';
        ?>



    <section id="profile" class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold"> User Profile</h2>
            <hr class="mx-auto">
        </div>

        <div class="mx-auto container">
            <form id="register-form" method="POST">
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" class="form-control" value="<?php echo $row['user_id']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" value="<?php echo $row['user_fname']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" value="<?php echo $row['user_lname']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Contact</label>
                    <input type="text" class="form-control" value="<?php echo $row['user_phone']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="<?php echo $row['user_email']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Registration Date</label>
                    <input type="text" class="form-control" value="<?php echo $row['user_regDate']; ?>" readonly>
                </div>


                <a href="home.php  "id="register-btn"  class="btn ">Back</a>


                
                <a href="edit-customer-profile.php?editid=<?php echo $row['user_id']; ?>" id="register-btn" class="btn ">Edit</a>
            </form>
        </div>
    </section>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
