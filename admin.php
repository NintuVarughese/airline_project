<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Page</title>
<style>
    /* CSS styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-image: url('https://tse1.mm.bing.net/th?id=OIP.bOtI1PpZcspc7H_11pWcUAHaDW&pid=Api&P=0&h=180'); /* Replace 'background_image.jpg' with your image path */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    h1 {
        text-align: center;
        color: #fff; /* Text color for better visibility */
    }
    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
    }
    label {
        display: block;
        margin-bottom: 10px;
    }
    input[type="text"], input[type="date"], input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    button {
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: #4CAF50;
        color: white;
    }
    button:hover {
        background-color: #45a049;
    }
</style>
<script>
// JavaScript code for form validation
function validateForm() {
    var fromLocation = document.getElementById("from_location").value;
    var toLocation = document.getElementById("to_location").value;
    var date = document.getElementById("date").value;
    var amount = document.getElementById("amount").value;

    if (fromLocation.trim() == "" || toLocation.trim() == "" || date.trim() == "" || amount.trim() == "") {
        alert("All fields must be filled out");
        return false;
    }
    return true;
}
</script>
</head>
<body>
    <h1>Add Flight Details</h1>
    <form id="flightForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
        <label for="from_location">From Location:</label>
        <input type="text" id="from_location" name="from_location" required><br><br>
        <label for="to_location">To Location:</label>
        <input type="text" id="to_location" name="to_location" required><br><br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required><br><br>
        <button type="submit">Add Flight</button>
    </form>
    <form action="viewuser.php">
        <button type="submit">View Users</button>
    </form>
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

// Insert flight details into flights table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fromLocation = $_POST["from_location"];
    $toLocation = $_POST["to_location"];
    $date = $_POST["date"];
    $amount = $_POST["amount"];

    $insert_sql = "INSERT INTO flight (from_location, to_location, date, amount) VALUES ('$fromLocation', '$toLocation', '$date', '$amount')";

    if ($conn->query($insert_sql) === TRUE) {
        // Flight details added successfully, redirect to flightd.php
        header("Location: flightd.php");
        exit;
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

</body>
</html>
