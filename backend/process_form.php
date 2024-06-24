<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Submission Result</h2>
        <?php
        // Example error handling and data insertion in process_form.php
        
        // Include database connection file
        include('connection.php'); // Adjust this line according to your actual connection file
        
        // Check if required parameters are set
        if (!isset($_GET['name']) || !isset($_GET['email']) || !isset($_GET['phone_number'])) {
            echo '<p class="error">Error: Required parameters missing.</p>';
        } else {
            // Assign form data to variables (sanitize if necessary)
            $name = $_GET['name'];
            $email = $_GET['email'];
            $phone_number = $_GET['phone_number'];
            $message = isset($_GET['message']) ? $_GET['message'] : "Empty"; // Check if 'message' is set
            
            // Escape variables for security (optional, but recommended)
            $name = mysqli_real_escape_string($conn, $name);
            $email = mysqli_real_escape_string($conn, $email);
            $phone_number = mysqli_real_escape_string($conn, $phone_number);
            $message = mysqli_real_escape_string($conn, $message);
            
            // SQL query to insert data into enquiries table
            $sql = "INSERT INTO enquiries (name, email, phone_number, message) VALUES ('$name', '$email', '$phone_number', '$message')";
            
            // Execute query and handle result
            if (mysqli_query($conn, $sql)) {
                echo '<p class="success">Data inserted successfully.</p>';
            } else {
                echo '<p class="error">Error: ' . mysqli_error($conn) . '</p>';
            }
        }
        
        // Close database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
