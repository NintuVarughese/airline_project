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

       
        input {
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
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
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
    <form id="bookingForm" action="" method="post">
        <label for="from">From:</label>
        <input type="text" id="from" name="from" required><br><br>
        
        <label for="to">To:</label>
        <input type="text" id="to" name="to" required><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>
        
        <label for="flightDate">Flight Date:</label>
        <input type="date" id="flightDate" name="flightDate" required><br><br>
        
        <!-- <input type="submit" value="Book Flight"> -->
        <a href="success.php" class="book-flight-btn">Book Flight</a>
    </form>

    <script>
        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var from = document.getElementById('from').value;
            var to = document.getElementById('to').value;
            var flightDate = document.getElementById('flightDate').value;

            if ( !name || !email || !phone ||!from || !to || !flightDate) {
                alert('Please fill in all fields');
                event.preventDefault();
            }
        });
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_air";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // $from = $_POST['from'];
        // $to = $_POST['to'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $from = $_POST['from'];
        $to = $_POST['to'];
        $flightDate = $_POST['flightDate'];

        $sql = "INSERT INTO user (name, email, phone,from_location, to_location, flightdate) VALUES ( '$name', '$email', '$phone','$from', '$to', '$flightDate')";

        if ($conn->query($sql) === TRUE) {
            // echo "Booking successful";
            $conn->close();

            // Redirect to success.php
            header("Location: success.php");
            exit(); // Ma
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>