<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Flight Details</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('https://tse2.mm.bing.net/th?id=OIP.TaG5gir2IbnmvUAgNqoIfgHaEK&pid=Api&P=0&h=180'); /* Add your background image URL here */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    form {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="date"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    button {
        padding: 10px 20px;
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
</head>
<body>
    <div class="container">
        <h1>Edit Flight Details</h1>
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

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $flight_id = $_GET['id'];
            // Fetch flight details based on the flight ID
            $sql = "SELECT * FROM flight WHERE id='$flight_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Display the edit form with pre-filled values
                ?>
                <form method="post" action="update.php">
                    <input type="hidden" name="id" value="<?php echo $flight_id; ?>">
                    <label for="from_location">From Location:</label>
                    <input type="text" id="from_location" name="from_location" value="<?php echo $row['from_location']; ?>" required><br><br>
                    <label for="to_location">To Location:</label>
                    <input type="text" id="to_location" name="to_location" value="<?php echo $row['to_location']; ?>" required><br><br>
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value="<?php echo $row['date']; ?>" required><br><br>
                    <label for="amount">Amount:</label>
                    <input type="text" id="amount" name="amount" value="<?php echo $row['amount']; ?>" required><br><br>
                    <button type="submit">Update Flight</button>
                </form>
                <?php
            } else {
                echo "Flight not found";
            }
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
