<?php
session_start();




if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: stylist-login.php");
    exit();
}



// Include necessary files and perform any other operations
include('server/connection.php');

// Fetch additional details from session
$stylist_id = $_SESSION['stylist_id'];
$stylist_email = $_SESSION['stylist_email'];
$stylist_status = isset($_SESSION['stylist_status']) ? $_SESSION['stylist_status'] : "Unknown"; // Fetch status or set a default value

if ($stmt = $conn->prepare("SELECT * FROM stylist WHERE stylist_id = ?")) {
    $stmt->bind_param("i", $stylist_id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Stylist data fetched successfully
        } else {
            echo "No stylist found with ID: " . $stylist_id;
        }
    } else {
        echo "Error executing SQL query: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing SQL statement: " . $conn->error;
}




?>

<!DOCTYPE HTML>
<html>
<head>
    <title>View Stylist Requests</title>
    <!-- Bootstrap Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel='stylesheet' type='text/css' />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Your custom styles here */
    </style>
</head>
<body>
    <?php include 'stylist-header.php'; ?>


    <section id="profile" class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold"> Stylist Profile</h2>
            <hr class="mx-auto">
        </div>

        <div class="mx-auto container">
            <form id="register-form" method="POST">
 
                
                    <div class="form-group">
                        <label>Stylist ID</label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_id']; ?>" readonly>
                    </div>

                    
                    <div class="form-group">
                        <label>Request Number</label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_reqno']; ?>" readonly>
                    </div>


                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_name']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_address']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_gender']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_contact']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Educational Level</label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_eduLevel']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Specialization Area</label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_speArea']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Qualifications</label>
                        <textarea class="form-control" readonly><?php echo $row['stylist_qualifications']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_email']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Stylist Registration Date</label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_registerDate']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <!-- Hidden input to store the status value -->
                        <input type="text" class="form-control" name="stylist_status" value="<?php echo $row['stylist_status']; ?>" readonly>
                        <!-- Span to display the selected status -->
                        <?php  
                            if($row['stylist_status'] == "Pending") {
                                echo "Not Updated Yet";
                            } elseif($row['stylist_status'] == "Selected") {
                                echo "Selected";
                            } elseif($row['stylist_status'] == "Rejected") {
                                echo "Rejected";
                            }
                        ?>
                    </div>

                    <div class="form-group">
                        <label> Remark </label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_remark']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Remark Date</label>
                        <input type="text" class="form-control" value="<?php echo $row['stylist_remarkDate']; ?>" readonly>
                    </div>

                    <a href="stylist-dashboard.php  "id="register-btn"  class="btn ">Back</a>

                    <a href="edit-stylist-profile.php?editid=<?php echo $row['stylist_id']; ?>" id="register-btn" class="btn ">Edit</a>


                </div>
            </form>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
