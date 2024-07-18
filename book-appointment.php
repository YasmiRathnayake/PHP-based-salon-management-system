


<?php





include('server/connection.php');




// Get service name and service category from URL parameters
$serviceName = isset($_GET['service_name']) ? htmlspecialchars($_GET['service_name']) : '';
$serviceCategory = isset($_GET['service_category']) ? htmlspecialchars($_GET['service_category']) : '';

if(isset($_POST['submit'])) {
    // Retrieve and sanitize form data
    // Assuming the appointment number is generated somehow, for this example let's say it's a random number
    $aptno = rand(100000, 999999);
    
    // Store appointment number in session
    $_SESSION['aptno'] = $aptno;

    // Redirect to Thank You page
    header('location: thank-you.php');
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

<!--APPOINTMENT FORM-->

<section id="register" class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Appointment Form</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
    <form id="register-form" method="POST" action="register.php" onsubmit="return validateForm()">

    <div class="form-group">
        <label>Service Name</label>
        <input type="text" class="form-control" name="service_name" value="<?php echo $serviceName; ?>" placeholder=" " required/>
    </div>

    <div class="form-group">
        <label>Service Category</label>
        <select class="form-control" name="service_category" required>
        <option value="" disabled>Select Service Category</option>
                <option value="hair" <?php echo ($serviceCategory == 'hair') ? 'selected' : ''; ?>>Hair</option>
                <option value="skin" <?php echo ($serviceCategory == 'skin') ? 'selected' : ''; ?>>Skin</option>
                <option value="body" <?php echo ($serviceCategory == 'body') ? 'selected' : ''; ?>>Body</option>
                <option value="nail" <?php echo ($serviceCategory == 'nail') ? 'selected' : ''; ?>>Nail</option>
        </select>
     </div>

    <div class="form-group">
        <label>Stylist Name</label>
        <select class="form-control" name="stylist_name" required>
        <option value="" disabled>Select Service Category</option>
        <?php
        if (!empty($serviceCategory)) {
            $sql = "SELECT stylist_name FROM stylist WHERE stylist_speArea = ? AND stylist_status = 'Accepted'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $serviceCategory);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['stylist_name'] . '">' . $row['stylist_name'] . '</option>';
            }
        }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label>Appointment Date</label>
        <input type="date" class="form-control" name="appointment_date"  placeholder="" required/>
    </div>

    <div class="form-group">
        <label>Appointment Time</label>
        <input type="time" class="form-control" name="appointment_time" placeholder=""  required/>
    </div>

    <div class="form-group">
        <label>Additional Details</label>
        <input type="email" class="form-control" name="additional_details"  placeholder="" />    
    </div>

    <div class="form-group">
        <input type="submit" class="btn" name="make-an-appointment" id="register-btn" value="Make an Appointment"/>
    </div>

    <div class="form-group">
        <a id="login-url" class="btn" href="home.php">Go Back</a>
    </div>
</form>

    </div>
</section>


<?php

include 'footer.php';


?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the current date
    var currentDate = new Date().toISOString().split('T')[0];

    // Set the min attribute of the date input field to the current date
    document.querySelector('input[type="date"]').setAttribute('min', currentDate);
});




function fetchStylists() {
    var serviceCategory = document.getElementById("service_category").value;
    var stylistDropdown = document.getElementById("stylist_name");

    // Clear previous options
    stylistDropdown.innerHTML = '<option value="" disabled>Select Stylist</option>';

    if(serviceCategory !== '') {
        // Send AJAX request to fetch stylists
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch_stylists.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if(this.status === 200) {
                var data = JSON.parse(this.responseText);
                
                // Update dropdown with fetched stylist names
                data.forEach(function(stylist) {
                    var option = document.createElement('option');
                    option.value = stylist.stylist_name;
                    option.textContent = stylist.stylist_name;
                    stylistDropdown.appendChild(option);
                });
            }
        }

        xhr.send('serviceCategory=' + serviceCategory);
    }
}

</script>






      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
  </html>