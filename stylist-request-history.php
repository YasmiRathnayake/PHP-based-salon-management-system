<?php
session_start();
include('server/connection.php');


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: stylist-login.php");
    exit();
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
    <title>Certificate</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .certificate-container {
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border: 10px solid #ddd;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .certificate-header {
            font-size: 2.5em;
            color: darkred;
            margin-bottom: 20px;
        }
        .certificate-subheader {
            font-size: 1.5em;
            color: darkslategray;
            margin-bottom: 40px;
        }
        .certificate-body {
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .certificate-footer {
            font-size: 1em;
            color: gray;
        }
        .table {
            width: 100%;
            margin: 20px 0;
            background: white;
            border: none;
        }
        .table thead th {
            background-color: lightcoral;
            color: white;
            border: 1px solid #ddd;
        }
        .table tbody tr {
            border-bottom: 1px solid #ddd;
        }
        .table tbody tr:last-child {
            border-bottom: none;
        }
        .table tbody td, .table tbody th {
            padding: 15px;
            text-align: center;
            border: none;
        }
        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }
        .btn {
            margin: 5px;
            padding: 8px 15px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: lightcoral;
            color: white;
        }
        .btn-danger {
            background-color: darkred;
            color: white;
        }
        .btn-primary:hover, .btn-danger:hover {
            opacity: 0.8;
        }

        .red-star {
            color: red;
            font-size: 8em;
            margin-top: 20px;
            
        }

        
    </style>
</head>
<body>
    <?php include 'stylist-header.php'; ?>
    <section id="all-stylist-requests" class="my-5 py-5">
        <div class="certificate-container">
            <div class="certificate-header">Certificate of Recognition</div>
            <div class="certificate-subheader">Awarded to</div>
            <div class="certificate-body">
                <strong><?php echo $stylist['stylist_name']; ?></strong><br>
                For exemplary performance and dedication in the field of <strong><?php echo $stylist['stylist_speArea']; ?></strong>.
            </div>
           <br>

            <div class="certificate-body">
                <p>This is to certify that <strong><?php echo $stylist['stylist_email']; ?></strong>,</p>
                <p>with Request Number <strong><?php echo $stylist['stylist_reqno']; ?></strong> and ID <strong><?php echo $stylist['stylist_id']; ?></strong>,</p>
                <p>has successfully registered on <strong><?php echo $stylist['stylist_registerDate']; ?></strong>.</p>
                <p>The current status of the request is <strong><?php echo $stylist['stylist_status']; ?></strong>.</p>
                <p>Remark Date: <strong> <?php echo $stylist['stylist_remarkDate']; ?></strong></p>

                <div class="red-star"><i class="fa-solid fa-certificate"></i></i></div>

            </div>
            <div class="certificate-footer">Issued on: <?php echo date('Y-m-d'); ?></div>
        </div>
    </section>
</body>
</html>

        </div>
    </section>
</body>
</html>
