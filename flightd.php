<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Flight Details</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('https://tse3.mm.bing.net/th?id=OIP.L2R3h-PZW03qbtIypZFNSQHaE7&pid=Api&P=0&h=180'); /* Replace 'background_image.jpg' with your image path */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #ffffff;
    }
    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
        border-radius: 10px;
    }
    h1 {
        text-align: center;
    }
    .flight-details {
        margin-top: 20px;
    }
    .flight-item {
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.2); /* Semi-transparent white background */
        border-radius: 5px;
        margin-bottom: 10px;
    }
    .button-container {
        text-align: center;
        margin-top: 10px;
    }
    .button-container button {
        margin-right: 10px;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: #4CAF50;
        color: white;
    }
    .button-container button:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Flight Details</h1>
        <div class="flight-details">
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

            // Handle flight deletion
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
                $delete_id = $_POST['delete_id'];
                $delete_sql = "DELETE FROM flight WHERE id = '$delete_id'";
                if ($conn->query($delete_sql) === TRUE) {
                    echo "<p>Flight ID $delete_id deleted successfully</p>";
                } else {
                    echo "Error deleting flight: " . $conn->error;
                }
            }

            // Fetch flight details from the database
            $sql = "SELECT * FROM flight";
            $result = $conn->query($sql);

            // Check if there are any flights
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<div class="flight-item">';
                    echo "Flight ID: " . $row["id"]. " - From: " . $row["from_location"]. " - To: " . $row["to_location"]. " - Date: " . $row["date"]. " - Amount: $" . $row["amount"];
                    // Add delete and edit buttons with form submission
                    echo '<div class="button-container">';
                    echo '<form method="post">';
                    echo '<input type="hidden" name="delete_id" value="' . $row["id"] . '">';
                    echo '<button type="submit">Delete</button>';
                    echo '</form>';
                    echo '<a href="edit.php?id=' . $row["id"] . '"><button>Edit</button></a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No flights available";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
