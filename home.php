<!DOCTYPE html>
<html>
<head>
    <title>Flight Booking Form</title>
    <style>
        body {
            background-image: url('https://www.lemax.net/wp-content/uploads/2018/04/flight-booking-software-fb.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.7);
        }

        input, textarea {
            margin-bottom: 10px;
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="submit"] {
            display: none;
        }

        /* Style the "Book Flight" link */
        .book-flight-btn {
            display: block;
            width: 100%;
            background-color: #fff; /* White background */
            color: #4CAF50; /* Green text color */
            border: 2px solid #4CAF50; /* Green border */
            padding: 8px; /* Adjust padding */
            text-align: center;
            text-decoration: none;
            font-size: 14px; /* Adjust font size */
            border-radius: 5px;
            margin-top: 10px; /* Add margin to match other input fields */
        }

        /* Hover effect for the "Book Flight" link */
        .book-flight-btn:hover {
            background-color: #4CAF50;
            color: #fff;
        }

    </style>
</head>
<body>
    <form id="bookingForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea><br><br>
        
        <!-- <input type="submit" value="Book Flight"> -->
        <a href="#" class="book-flight-btn" onclick="validateForm()">Book Flight</a>
    </form>

    <script>
        function validateForm() {
            var name = document.getElementById('name').value;
            var age = document.getElementById('age').value;
            var phone = document.getElementById('phone').value;
            var email = document.getElementById('email').value;
            var address = document.getElementById('address').value;

            if (!name || !age || !phone || !email || !address) {
                alert('Please fill in all fields');
            } else {
                // Proceed with booking
                document.getElementById('bookingForm').submit();
            }
        }
    </script>

    <?php
    // Database configuration
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

    // Create table query
    $create_table_query = "CREATE TABLE IF NOT EXISTS user (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(255) NOT NULL,
                            age INT NOT NULL,
                            phone VARCHAR(20) NOT NULL,
                            email VARCHAR(255) NOT NULL,
                            address TEXT NOT NULL
                        )";

    // Execute create table query
    if ($conn->query($create_table_query) === TRUE) {
        echo "Table created successfully.<br>";
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }

    // Close connection
    $conn->close();

    // Insert data into user table
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $name = $_POST['name'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        // Prepare and bind statement
        $stmt = $conn->prepare("INSERT INTO user (name, age, phone, email, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $name, $age, $phone, $email, $address);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to payment page
            header("Location: payment.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();

        // Close connection
        $conn->close();
    }
    ?>
</body>
</html>
