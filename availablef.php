<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Flights</title>
<style>
    /* CSS styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('https://www.lemax.net/wp-content/uploads/2018/04/flight-booking-software-fb.jpg'); /* Add your background image URL here */
        background-size: cover;
        background-repeat: no-repeat;
    }
    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.9); /* Add some transparency to the background color */
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333; /* Change title color */
    }
    .flight-item {
        padding: 15px;
        border-bottom: 1px solid #ccc;
        margin-bottom: 20px;
        background-color: #f9f9f9; /* Light gray background */
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .flight-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    .book-button {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 8px 15px;
        border-radius: 3px;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s ease; /* Add smooth transition effect */
    }
    .book-button:hover {
        background-color: #45a049;
    }
    strong {
        color: #333; /* Change strong tag color */
    }
</style>
</head>
<body>
    <div class="container">
        <h1>View Flights</h1>
        <div id="flightList">
            <?php
            // Include database connection file
            include('db_conn.php');

            // Fetch flights from database
            $sql = "SELECT * FROM flight";
            $result = $conn->query($sql);

            // Check if there are any flights
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<div class="flight-item">';
                    echo "<strong>Flight ID:</strong> " . $row["id"]. "<br>";
                    echo "<strong>From:</strong> " . $row["from_location"]. "<br>";
                    echo "<strong>To:</strong> " . $row["to_location"]. "<br>";
                    echo "<strong>Date:</strong> " . $row["date"]. "<br>";
                    // Add the amount
                    echo "<strong>Amount:</strong> $" . $row["amount"]. "<br>";
                    // Add Book button with onclick event
                    echo '<button class="book-button" onclick="bookFlight(' . $row["id"] . ')">Book</button>';
                    echo '</div>';
                }
            } else {
                echo "No flights available";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script>
    // JavaScript function to handle booking flight
    function bookFlight(flightId) {
        // Redirect to home.php with flight ID as parameter
        window.location.href = 'home.php?flight_id=' + flightId;
    }
    </script>
</body>
</html>
