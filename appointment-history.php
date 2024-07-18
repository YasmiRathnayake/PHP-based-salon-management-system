<?php
session_start();
include('server/connection.php');

if(!isset($_SESSION['stylist_email'])){
    header('Location: login.php');
    exit;
}

$stylist_email = $_SESSION['stylist_email'];
$stylist_id = $_SESSION['stylist_id'];

$stmt = $conn->prepare("SELECT * FROM stylist WHERE stylist_email = ?");
$stmt->bind_param("s", $stylist_email);
$stmt->execute();
$result = $stmt->get_result();
$stylist = $result->fetch_assoc();

$stmt->close();
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


include 'stylist-header.php';

?>



<section id="all-stylist-requests" class="my-5 py-5">
    <div class="container">

        <h1>Welcome, <?php echo $stylist['stylist_name']; ?></h1>
        <div class="table-responsive ">
            <table class="table table-bordered">
            <thead>
                <tr>



                    <th>stylist_reqno</th>
                    <th>ID</th>
                    <th>Name</th>

                    <th>Email</th>
                    <th>Registration Date</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>Remark Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $stylist['stylist_reqno']; ?></td>
                    <td><?php echo $stylist['stylist_id']; ?></td>
                    <td><?php echo $stylist['stylist_name']; ?></td>
            

                    <td><?php echo $stylist['stylist_email']; ?></td>
                    <td><?php echo $stylist['stylist_registerDate']; ?></td>
                    <td><?php echo $stylist['stylist_status']; ?></td>
                    <td><?php echo $stylist['stylist_remark']; ?></td>
                    <td><?php echo $stylist['stylist_remarkDate']; ?></td>
                </tr>
            </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
