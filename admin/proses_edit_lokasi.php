<?php
include '../koneksi/koneksi.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get latitude and longitude from the form
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    
    $id = '1';

    // Update data in the lokasi table
    $sql = "UPDATE lokasi SET latitude='$latitude', longitude='$longitude' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: intansi.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
