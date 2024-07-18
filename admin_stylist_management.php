<?php
session_start();
include('server/connection.php');

// Check if the user is logged in as admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Fetch pending stylist registrations
$stmt = $conn->prepare("SELECT * FROM stylist WHERE stylist_status = 'Pending'");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Stylist Management</title>
    <!-- Add your CSS and JavaScript links here -->
</head>
<body>
    <h1>Stylist Registrations (Pending)</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['stylist_name']; ?></td>
            <td><?php echo $row['stylist_email']; ?></td>
            <td>
                <!-- Form to update status -->
                <form method="post" action="update_stylist_status.php">
                    <input type="hidden" name="stylist_id" value="<?php echo $row['stylist_id']; ?>">
                    <select name="status">
                        <option value="Approved">Approve</option>
                        <option value="Rejected">Reject</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
