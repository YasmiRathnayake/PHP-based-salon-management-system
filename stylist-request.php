<?php
session_start();
error_reporting(0);
include('server/connection.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}




// Fetch all stylist requests with status "Pending" from the database
$stmt = $conn->prepare("SELECT * FROM stylist WHERE stylist_status = 'Pending'");
$stmt->execute();
$result = $stmt->get_result();


// Include header

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
<?php


include 'admin-header.php';

?>



<section id="all-stylist-requests" class="my-5 py-5">
    <div class="container">
        <h2 class="text-center">New Requests</h2>
        <div class="table-responsive ">
            <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Eduacation Level</th>
                                <th>Specialization Area</th>
                                <th>Email</th>
                                <th>Stylist Registration Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
    $cnt = 1;
    while ($row = $result->fetch_assoc()) {
    ?>
        <tr>
            <td><?php echo $cnt++; ?></td>
            <td><?php echo $row['stylist_name']; ?></td>
            <td><?php echo $row['stylist_contact']; ?></td>
            <td><?php echo $row['stylist_eduLevel']; ?></td>
            <td><?php echo $row['stylist_speArea']; ?></td>
            <td><?php echo $row['stylist_email']; ?></td>
            <td><?php echo $row['stylist_registerDate']; ?></td>
            <td><?php echo $row['stylist_status']; ?></td>
            <td>
                <a href="view-stylist-request.php?stylist_id=<?php echo $row['stylist_id']; ?>" class="btn btn-primary">View Details</a>
                <!-- <a href="process-stylist-request.php?reject=<?php echo $row['stylist_id']; ?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to reject?')">Reject</a> -->
            </td>
        </tr>
    <?php
    }
    ?>
</tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
