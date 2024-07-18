<?php
session_start();
error_reporting(0);
include('server/connection.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}



if(isset($_POST['submit'])){

    $stylist_name = $_POST['stylist_name'];
    $stylist_address = $_POST['stylist_address'];
    $stylist_contact = $_POST['stylist_contact'];
    $stylist_eduLevel = $_POST['stylist_eduLevel'];
    $stylist_speArea = $_POST['stylist_speArea'];
    $stylist_qualifications = $_POST['stylist_qualifications'];
    
    // Get the editid from URL
    $eid = $_GET['editid'];  
    

    $stmt = $conn->prepare("UPDATE stylist SET stylist_name=?, stylist_address=?, stylist_contact=?, stylist_eduLevel=?, stylist_speArea=?, stylist_qualifications=? WHERE stylist_id=?");
    $stmt->bind_param("ssssssi", $stylist_name, $stylist_address, $stylist_contact, $stylist_eduLevel, $stylist_speArea, $stylist_qualifications, $eid);

    if($stmt->execute()){
        echo "<script>alert('Stylist Profile Updated Successfully');</script>";
        echo "<script>window.location.href = 'edit-stylist.php';</script>"; // Navigate to test.php
    } else {
        echo "SQL Error: " . $stmt->error;
    }
    $stmt->close();
}


$eid = $_GET['editid'] ?? '';
$stmt = $conn->prepare("SELECT * FROM stylist WHERE stylist_id = ?");
$stmt->bind_param("i", $eid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();


?>




<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Stylist Profile</title>
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
            <h2 class="form-weight-bold">Update Your Profile</h2>
            <hr class="mx-auto">
        </div>

        <div class="mx-auto container">
            <form id="register-form" method="POST">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="stylist_name" value="<?php echo $row['stylist_name']; ?>" >
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="stylist_address" value="<?php echo $row['stylist_address']; ?>" >
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <input type="text" class="form-control" name="stylist_contact" value="<?php echo $row['stylist_contact']; ?>" >
                </div>

                <div class="form-group">
                    <label>Specialization Area</label>
                    <select class="form-control" name="stylist_speArea" required>
                        <option value="" disabled>Select Service Category</option>
                        <option value="hair" <?php echo ($row['stylist_speArea'] == 'hair') ? 'selected' : ''; ?>>Hair</option>
                        <option value="skin" <?php echo ($row['stylist_speArea'] == 'skin') ? 'selected' : ''; ?>>Skin</option>
                        <option value="body" <?php echo ($row['stylist_speArea'] == 'body') ? 'selected' : ''; ?>>Body</option>
                        <option value="nail" <?php echo ($row['stylist_speArea'] == 'nail') ? 'selected' : ''; ?>>Nail</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Educational Level</label>
                    <select class="form-control" name="stylist_eduLevel" required>
                        <option value="" disabled>Select Education Level</option>
                        <option value="Vocational Training/Certificate Programs" <?php echo ($row['stylist_eduLevel'] == 'Vocational Training/Certificate Programs') ? 'selected' : ''; ?>>Vocational Training/Certificate Programs</option>
                        <option value="Diploma in Beauty Therapy/Cosmetology" <?php echo ($row['stylist_eduLevel'] == 'Diploma in Beauty Therapy/Cosmetology') ? 'selected' : ''; ?>>Diploma in Beauty Therapy/Cosmetology</option>
                        <option value="Associate Degree in Beauty Science/Cosmetology" <?php echo ($row['stylist_eduLevel'] == 'Associate Degree in Beauty Science/Cosmetology') ? 'selected' : ''; ?>>Associate Degree in Beauty Science/Cosmetology</option>
                        <option value="Bachelor's Degree in Cosmetology/Beauty Science" <?php echo ($row['stylist_eduLevel'] == "Bachelor's Degree in Cosmetology/Beauty Science") ? 'selected' : ''; ?>>Bachelor's Degree in Cosmetology/Beauty Science</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Qualifications</label>
                    <textarea class="form-control" name="stylist_qualifications"><?php echo $row['stylist_qualifications']; ?></textarea>
                </div>

                <input type="submit" class="btn" name="submit" id="register-btn" value="Update Profile"/>


            </form>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>