<?php
include('db_conn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $cardId = $_POST['cardId'];

    // Check if all fields are filled
    if (!empty($name) && !empty($amount) && !empty($cardId)) {
        // Insert data into the database
        $sql = "INSERT INTO payment (name, amount, cardid) VALUES ('$name', '$amount', '$cardId')";
        
        if ($conn->query($sql) === TRUE) {
            // Redirect to success.php
            header("Location: success.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Please fill in all fields";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-image: url('https://image.freepik.com/free-vector/payment-background-design_1212-511.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.8); /* Add some transparency to make the text readable */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Payment Details</h2>
        <form id="paymentForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" min="0" required>
            
            <label for="cardId">Card ID:</label>
            <input type="text" id="cardId" name="cardId" required>

            <input type="submit" value="Submit Payment">
        </form>
    </div>
</body>
</html>
