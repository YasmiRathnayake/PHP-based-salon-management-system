<?php
session_start();
error_reporting(0);
include('server/connection.php');


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}



if(isset($_POST['submit'])){
    $stylist_status = $_POST['stylist_status'];
    $stylist_remark = $_POST['stylist_remark'];
    $stylist_remarkDate = date('Y-m-d H:i:s'); // Current timestamp
    $stylist_id = $_POST['stylist_id'];  // Get the stylist_id from form data
    
    $stmt = $conn->prepare("UPDATE stylist SET stylist_status=?, stylist_remark=?, stylist_remarkDate=? WHERE stylist_id=?");
    $stmt->bind_param("sssi", $stylist_status, $stylist_remark, $stylist_remarkDate, $stylist_id);
    
    if($stmt->execute()){
        echo "<script>alert('Stylist status updated successfully');</script>";
        echo "<script>window.location.href = 'all-stylist-request.php';</script>";
    } else {
        echo "<script>alert('Error updating stylist status');</script>";
    }
    $stmt->close();
}

// Fetch stylist data
$stylist_id = $_GET['stylist_id'] ?? '';
$stmt = $conn->prepare("SELECT * FROM stylist WHERE stylist_id = ?");
$stmt->bind_param("i", $stylist_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();  // Fetch a single row since we are editing one service
$stmt->close();




if(isset($_POST['update_status'])){
    $new_status = $_POST['new_status'];
    $stylist_id = $_POST['stylist_id'];
    $stylist_remark = $_POST['stylist_remark'];
    $stylist_remarkDate = date('Y-m-d H:i:s'); // Current timestamp

    // Prepare and execute the SQL query to update stylist status and remark
    $stmt = $conn->prepare("UPDATE stylist SET stylist_status=?, stylist_remark=?, stylist_remarkDate=? WHERE stylist_id=?");
    $stmt->bind_param("sssi", $new_status, $stylist_remark, $stylist_remarkDate, $stylist_id);

    if($stmt->execute()){
        echo "<script>alert('Stylist status updated successfully');</script>";
        // Redirect or perform any other action after updating the status
    } else {
        echo "<script>alert('Error updating stylist status');</script>";
    }
    $stmt->close();
}




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
    <?php include 'admin-header.php'; ?>
    
 

    <section id="register" class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">View Stylist Requests</h2>
            <hr class="mx-auto">
        </div>

        <div class="mx-auto container">
  
            <form id="register-form" method="POST">
                <div class="row">
                   
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
                            <label>Stylist Registraton Date</label>
                            <input type="text" class="form-control" value="<?php echo $row['stylist_registerDate']; ?>" readonly>
                        </div>

                        
                        <div class="form-group">
                            <label>Status</label>
                            <!-- Hidden input to store the status value -->
                            <input type="text" class="form-control" name="stylist_status" value="<?php echo $row['stylist_status']; ?>"  readonly>
                            <!-- Span to display the selected status -->
                            <span id="selected_status"><?php echo $row['stylist_status']; ?></span>

                            <?php  
                                if($row['stylist_status']=="Pending")
                                {
                                echo "Not Updated Yet";
                                }

                                if($row['stylist_status']=="Selected")
                                {
                                echo "Selected";
                                }

                                if($row['stylist_status']=="Rejected")
                                {
                                echo "Rejected";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </form>
            


                    <form id="update-status-form" method="POST">
                        <div class="form-group">
                            <label for="remark">Remark:</label>
                            <textarea id="remark" name="stylist_remark" placeholder="Enter remark" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="new-status">New Status:</label>
                            <select id="new-status" class="form-control" name="new_status" required>
                                <option value="" disabled selected>Select new status</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="stylist_id" value="<?php echo $row['stylist_id']; ?>">

                            

                            <button type="submit" name="update_status" class="btn btn-primary">Update Status</button>
                        </div>
                    </form>




        </div>
    </section>




    <script>
        // Add event listener to the dropdown
        document.getElementById("statusDropdown").addEventListener("change", function() {
            // Update the inner HTML of the status span with the selected value
            document.getElementById("selected_status").innerText = this.value;
        });
    </script>

    <?php include 'footer.php'; ?>







    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
