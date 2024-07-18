<?php
session_start();


include('server/connection.php');

if (isset($_POST['submit'])) {

    $stylist_name = $_POST['stylist_name'];
    $stylist_address = $_POST['stylist_address'];
    $stylist_gender = $_POST['stylist_gender'];
    $stylist_contact = $_POST['stylist_contact'];
    $stylist_eduLevel = $_POST['stylist_eduLevel'];
    $stylist_speArea = $_POST['stylist_speArea'];
    $stylist_qualifications = $_POST['stylist_qualifications'];
    $stylist_email = $_POST['stylist_email'];
    $stylist_password = password_hash($_POST['stylist_password'], PASSWORD_DEFAULT); // Hash the password


    $stmt_check_email = $conn->prepare("SELECT stylist_email FROM stylist WHERE stylist_email = ?");
    $stmt_check_email->bind_param("s", $stylist_email);
    $stmt_check_email->execute();
    $stmt_check_email->store_result();

    if ($stmt_check_email->num_rows > 0) {
        echo "<script>alert('Error: This email is already registered. Please use a different email.');</script>";
        echo "<script>window.location.href = 'stylist-registration.php';</script>";
        $stmt_check_email->close();
        exit(); 
    }
    $stmt_check_email->close();

    
    $reqno = rand(100000, 999999);

 
    $stmt = $conn->prepare("INSERT INTO stylist (stylist_name, stylist_address, stylist_gender, stylist_contact, stylist_eduLevel, stylist_speArea, stylist_qualifications, stylist_email, stylist_password, stylist_status, stylist_reqno) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', ?)");
    $stmt->bind_param("sssisssssi", $stylist_name, $stylist_address, $stylist_gender, $stylist_contact, $stylist_eduLevel, $stylist_speArea, $stylist_qualifications, $stylist_email, $stylist_password, $reqno);

    if ($stmt->execute()) {
        
        $_SESSION['reqno'] = $reqno;

        
        header('Location: stylist-thank-you.php');
        exit();
    } else {
        echo "<script>alert('Error: Unable to register.');</script>";
 
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylist Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

<?php include 'header.php'; ?>

<section id="stylist-register" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Stylist Registration Form</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form id="register-form" method="POST" action="" onsubmit="return validateForm()">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="stylist_name" placeholder="" required/>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="stylist_address" placeholder="" required/>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select class="form-control" name="stylist_gender" required>
                    <option value="" disabled selected>Select your Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" class="form-control" name="stylist_contact" minlength="10" maxlength="10" pattern="07\d{8}" title="Please enter a 10-digit phone number starting with 07" placeholder="" required/>
                <div id="phone-error" style="display: none; color: red;">Phone number must be 10 digits and start with 07</div>
            </div>
            <div class="form-group">
                <label>Education Level</label>
                <select class="form-control" name="stylist_eduLevel" required>
                    <option value="" disabled selected>Select your Education</option>
                    <option value="Vocational Training/Certificate Programs">Vocational Training/Certificate Programs</option>
                    <option value="Diploma in Beauty Therapy/Cosmetology">Diploma in Beauty Therapy/Cosmetology</option>
                    <option value="Associate Degree in Beauty Science/Cosmetology">Associate Degree in Beauty Science/Cosmetology</option>
                    <option value="Bachelors Degree in Cosmetology/Beauty Science">Bachelor's Degree in Cosmetology/Beauty Science</option>
                </select>
            </div>
            <div class="form-group">
                <label>Specialization Area</label>
                <select class="form-control" name="stylist_speArea" required>
                    <option value="" disabled selected>Select your Specialization</option>
                    <option value="hair">Hair</option>
                    <option value="skin">Skin</option>
                    <option value="body">Body</option>
                    <option value="nail">Nail</option>
                </select>
            </div>
            <div class="form-group">
                <label>Qualifications</label>
                <textarea class="form-control" name="stylist_qualifications" required></textarea>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="stylist_email" placeholder="" required/>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="stylist_password" class="form-control" name="stylist_password" placeholder="" minlength="6" required/>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" id="stylist_confirmPassword" class="form-control" name="stylist_confirmPassword" placeholder="Confirm Password" minlength="6" required/>
                <div id="password-error" style="display: none; color: red;">Passwords do not match!</div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" name="submit" id="register-btn" value="Become a Stylist"/>
            </div>
            <div class="form-group">
                <a id="login-url" class="btn" href="stylist-login.php">Do you have an account? Login here.</a>
            </div>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>

<script>
document.getElementById("stylist_contact").addEventListener("input", function(event) {
    var phoneNumber = event.target.value;
    var phoneNumberError = document.getElementById("phone-error");

    if (!/^07\d{8}$/.test(phoneNumber)) {
        phoneNumberError.style.display = "block";
    } else {
        phoneNumberError.style.display = "none";
    }
});

function validateForm() {
    var password = document.getElementById("stylist_password").value;
    var confirmPassword = document.getElementById("stylist_confirmPassword").value;

    if (password !== confirmPassword) {
        document.getElementById("password-error").style.display = "block";
        return false; // Prevent form submission
    }
    return true;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></






      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>