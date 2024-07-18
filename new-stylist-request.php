<?php
session_start();
error_reporting(0);
include('server/connection.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

    header("Location: admin-login.php");
    exit();
}





// Fetch new stylist requests (status = 'pending') from the database
$stmt = $conn->prepare("SELECT * FROM stylist WHERE status = 'not yet updated'");
$stmt->execute();
$result = $stmt->get_result();


include 'admin-header.php';
?>

<!-- Display new stylist requests in a table -->
<section id="new-stylist-requests" class="my-5 py-5">
    <div class="container">
        <h2 class="text-center">New Requests</h2>
        <div class="table-responsive ">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Contact Number</th>
                        <th>Eduacation Level</th>
                        <th>Specialization Area</th>
                        <th>Qualifications</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['stylist_name']; ?></td>
                            <td><?php echo $row['stylist_address']; ?></td>
                            <td><?php echo $row['stylist_gender']; ?></td>
                            <td><?php echo $row['stylist_contact']; ?></td>
                            <td><?php echo $row['stylist_eduLevel']; ?></td>
                            <td><?php echo $row['stylist_speArea']; ?></td>
                            <td><?php echo $row['stylist_qualifications']; ?></td>
                            <td><?php echo $row['stylist_email']; ?></td>
                            <td><?php echo $row['stylist_status']; ?></td>
                            <td><?php echo $row['stylist_remarks']; ?></td>
                            <td>
                                <form method="POST" action="update-stylist-request.php">
                                    <input type="hidden" name="stylist_id" value="<?php echo $row['stylist_id']; ?>">
                                    <select name="status">
                                        <option value="approved">Approve</option>
                                        <option value="rejected">Reject</option>
                                    </select>
                                    <textarea name="remarks" placeholder="Add remarks"></textarea>
                                    <button type="submit" name="update">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php
// Include footer
include 'footer.php';
?>
