





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        h5 {
            font-size: 1rem !important;
            font-weight: 400 !important;
        }
        h4 {
            font-size: 1.2rem !important;
            font-weight: 600 !important;
        }
        body {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            background-color: #f8f9fa !important;
            margin: 0 !important;
            min-height: 100vh !important;
        }
        .main-content {
            width: 100% !important;
            max-width: 1200px !important;
            margin: 20px !important;
        }
        #page-wrapper {
            padding: 20px !important;
            background-color: #f6efef !important;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1) !important;
            border-radius: 10px !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 20px !important;
        }
        .widget {
            background: rgba(255, 255, 255, 0.9) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            border-radius: 10px !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
            text-align: center !important;
            padding: 20px !important;
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            margin: 20px !important;
        }
        .row-one {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 20px !important;
        }
        .widget h4, .widget h5 {
            margin: 0 !important;
            color: #333 !important;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif !important;
        }
        .widget label {
            display: block !important;
            font-size: 1.5em !important;
            color: #dc3545 !important;
            margin-top: 10px !important;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif !important;
        }
        @media (max-width: 768px) {
            .row-one {
                flex-direction: column !important;
            }
        }
        .dashboard-table-container {

            margin-top: 120px !important;
}
    </style>
</head>







<body class="cbp-spmenu-push">






<?php
include 'admin-header.php';
?>






    <div class="main-content">
    <div id="page-wrapper" class="widget-shadow dashboard-table-container">
        <!-- <div id="page-wrapper" class="widget-shadow table-container"> -->
            <div class="main-page">
                <div class="row-one">
                    <div class="widget">
                        <div>
                            <h5>Total</h5>
                            <h4>Customer</h4>
                        </div>
                        <label>Number</label>
                    </div>
                    <div class="widget">
                        <div>
                            <h5>Total</h5>
                            <h4>Appointment</h4>
                        </div>
                        <label>Number</label>
                    </div>
                    <div class="widget">
                        <div>
                            <h5>Total</h5>
                            <h4>Accepted Apt</h4>
                        </div>
                        <label>Number</label>
                    </div>
                </div>
                <div class="row-one">
                    <div class="widget">
                        <div>
                            <h5>Total</h5>
                            <h4>Rejected Apt</h4>
                        </div>
                        <label>Number</label>
                    </div>
                    <div class="widget">
                        <div>
                            <h5>Total</h5>
                            <h4>Services</h4>
                        </div>
                        <label>Number</label>
                    </div>
                    <div class="widget">
                        <div>
                            <h5>Today</h5>
                            <h4>Sales</h4>
                        </div>
                        <label>Amount</label>
                    </div>
                </div>
                <div class="row-one">
                    <div class="widget">
                        <div>
                            <h5>Yesterday</h5>
                            <h4>Sales</h4>
                        </div>
                        <label>Amount</label>
                    </div>
                    <div class="widget">
                        <div>
                            <h5>Last Sevendays</h5>
                            <h4>Sale</h4>
                        </div>
                        <label>Amount</label>
                    </div>
                    <div class="widget">
                        <div>
                            <h5>Total</h5>
                            <h4>Sales</h4>
                        </div>
                        <label>Amount</label>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer-section">
            <!-- Footer content -->
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBYFAdY6MtS1W8XK3Jzwhm9J8TGaAwl5p5G1X6EGWMe+6bmM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-QF5keNbfjNJeY3zxyLhPtg6MXaw1BfS3eHvl0fG8G9hXZRmT5F59p6Wt6L8qrpu4" crossorigin="anonymous"></script>
</body>
</html>
