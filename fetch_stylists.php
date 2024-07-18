<?php
include('server/connection.php');

if(isset($_POST['serviceCategory'])) {
    $serviceCategory = $_POST['serviceCategory'];

    $sql = "SELECT stylist_name FROM stylist WHERE stylist_speArea = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $serviceCategory);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $stylists = [];

    while($row = $result->fetch_assoc()) {
        $stylists[] = $row;
    }

    echo json_encode($stylists);
}
?>
