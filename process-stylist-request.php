<?php
session_start();
include('server/connection.php');

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: admin-login.php");
    exit();
}

// Check if the reject parameter is set
if (isset($_GET['reject'])) {
    $stylist_id = $_GET['reject'];

    // Prepare the SQL statement to delete the row
    $stmt = $conn->prepare("DELETE FROM stylist WHERE stylist_id = ?");
    $stmt->bind_param('i', $stylist_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the page with stylist requests
        
        echo "<script>alert('Request is deleted.');</script>";
        header("Location: stylist-request.php");
        exit();
    } else {

        echo "<script>alert('Error: Could not delete the stylist request');</script>";

    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
