<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_air";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $flight_id = $_POST['id'];
    $fromLocation = $_POST["from_location"];
    $toLocation = $_POST["to_location"];
    $date = $_POST["date"];

    // Update flight details in the flights table
    $update_sql = "UPDATE flight SET from_location='$fromLocation', to_location='$toLocation', date='$date' WHERE id='$flight_id'";

    if ($conn->query($update_sql) === TRUE) {
        // Flight details updated successfully, redirect to flight details page
        header("Location: flightd.php");
        exit;
    } else {
        echo "Error updating flight details: " . $conn->error;
    }
}

$conn->close();
?>
