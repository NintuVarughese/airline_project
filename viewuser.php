<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Users</title>
<style>
    /* CSS styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('https://tse1.mm.bing.net/th?id=OIP.bOtI1PpZcspc7H_11pWcUAHaDW&pid=Api&P=0&h=180'); /* Replace 'background_image.jpg' with your image path */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #ffffff;
    }
    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black background */
        border-radius: 10px;
    }
    h1 {
        text-align: center;
    }
    .user-details {
        margin-top: 20px;
    }
    .user-item {
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.2); /* Semi-transparent white background */
        border-radius: 5px;
        margin-bottom: 10px;
        position: relative; /* To position the delete button */
    }
    .delete-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        padding: 5px 10px;
        background-color: #ff0000;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>User Details</h1>
        <div class="user-details">
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_air"; // Replace 'your_database_name' with your actual database name

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Handle user deletion
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
                $delete_id = $_POST['delete_id'];
                // SQL to delete user from the database
                $delete_sql = "DELETE FROM user WHERE id='$delete_id'";
                if ($conn->query($delete_sql) === TRUE) {
                    echo "User deleted successfully.";
                } else {
                    echo "Error deleting user: " . $conn->error;
                }
            }

            // Fetch user details from the database
            $sql = "SELECT * FROM user"; // Replace 'user' with your actual table name
            $result = $conn->query($sql);

            // Check if there are any users
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<div class="user-item">';
                    echo "User ID: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. " - Phone: " . $row["phone"];
                    // Add delete button with user ID as parameter
                    echo '<button class="delete-btn" onclick="deleteUser(' . $row["id"] . ')">Delete</button>';
                    echo '</div>';
                }
            } else {
                echo "No users available";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script>
    // JavaScript function to delete user
    function deleteUser(userId) {
        if (confirm("Are you sure you want to delete this user?")) {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Define the request parameters
            xhr.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Define the callback function
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page to reflect the changes
                    location.reload();
                }
            };

            // Send the request with the user ID as parameter
            xhr.send("delete_id=" + userId);
        }
    }
    </script>
</body>
</html>
