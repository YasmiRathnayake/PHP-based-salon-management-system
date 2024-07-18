<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

    
    <style>

/* Apply styles to the sidebar */

.container {
            display: flex;
            flex-direction: row;
        }

        .content {
            flex-grow: 1;
            /* Your content styles */
        }
#sidebar {
    margin-top: 9%;
    width: 250px;
    height: 100%;
    margin-left: 2%;
    top: 0;
    left: 0;
    background: rgba(255, 255, 255, 0.9);
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 20px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(20px);
    padding: 20px;
}

.sidebar-logo a {
    color: lightcoral;
    font-weight: bold;
    font-size: 1.5rem;
    text-decoration: none;
}

.sidebar-nav .sidebar-link {
    color: #333;
    display: flex;
    align-items: center;
    text-decoration: none;
    padding: 10px 0;
}

.sidebar-nav .sidebar-link:hover {
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 10px;
}

.sidebar-nav .sidebar-link .lni {
    margin-right: 10px;
}

/* Apply styles to dropdown menus */
.sidebar-dropdown {
    margin-left: 20px;
}

.sidebar-dropdown .sidebar-link {
    padding-left: 20px;
}


.adjust-margin-top {
    margin-top: 200px; /* Adjust the value as needed */
}




    .wrapper {
            width: auto;
            display: inline-block;
            margin-top: 3%;
        }
</style>





</head>
<body>
 


<?php

include 'admin-header.php';

?>


<div class="wrapper">
    <aside id="sidebar">
       
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span> Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown" data-bs-toggle="collapse" data-bs-target="#servicesDropdown" aria-expanded="false" aria-controls="servicesDropdown">
                    <i class="lni lni-user"></i>
                    <span>Services</span>
                </a>
                <ul id="servicesDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="add-service.php" class="sidebar-link">Add Service</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="manage-service.php" class="sidebar-link">Manage Service</a>
                    </li>
                </ul>
            </li>



            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown" data-bs-toggle="collapse" data-bs-target="#appointmentDropdown" aria-expanded="false" aria-controls="appointmentDropdown">
                    <i class="lni lni-user"></i>
                    <span>Appointment</span>
                </a>
                <ul id="appointmentDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">All Appointment</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">New Appointment</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Accepted Appointment</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Rejected Appointment</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown" data-bs-toggle="collapse" data-bs-target="#stylistDropdown" aria-expanded="false" aria-controls="stylistDropdown">
                    <i class="lni lni-user"></i>
                    <span>Stylist </span>
                </a>
                <ul id="stylistDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">All stylist</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">New stylist Request</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Accepted stylist Request</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Rejected stylist Request</a>
                    </li>
                </ul>
            </li>


            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span> Customer List</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown" data-bs-toggle="collapse" data-bs-target="#refundDropdown" aria-expanded="false" aria-controls="refundDropdown">
                    <i class="lni lni-user"></i>
                    <span>Refunds</span>
                </a>
                <ul id="refundDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">All Refund Request</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">New Refund Request</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Accepted Refund</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Rejected Refund</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#" class="sidebar-link has-dropdown" data-bs-toggle="collapse" data-bs-target="#inquiryDropdown" aria-expanded="false" aria-controls="inquiryDropdown">
                    <i class="lni lni-user"></i>
                    <span>Inquiry</span>
                </a>
            <ul id="inquiryDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">New Inquiry</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Manage Inquiry</a>
                    </li>
                </ul>


                <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span> Invoice</span>
                </a>
            </li>

        </ul>
        <ul class="sidebar-nav mt-10 adjust-margin-top"> 
    <li class="sidebar-item">
        <a href="#" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span> Logout</span>
        </a>
    </li>
</ul>

    </aside>
</div>


             

<!-- ... (Your HTML code remains unchanged) ... -->

<script>
    // Toggle Sidebar
document.getElementById('toggle-btn').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('active');
});

// Close other dropdowns when one is opened
let dropdownToggles = document.querySelectorAll('.has-dropdown');

dropdownToggles.forEach(function(dropdownToggle) {
    dropdownToggle.addEventListener('click', function() {
        let target = dropdownToggle.getAttribute('data-bs-target');
        let dropdown = document.querySelector(target);

        // Close other dropdowns
        let allDropdowns = document.querySelectorAll('.sidebar-dropdown');
        allDropdowns.forEach(function(d) {
            if (d !== dropdown && d.classList.contains('show')) {
                let bootstrapDropdown = new bootstrap.Collapse(d);
                bootstrapDropdown.hide();
            }
        });
    });
}); 



</script>

<!-- Bootstrap JS and Popper.js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
