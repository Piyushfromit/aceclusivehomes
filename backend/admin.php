<?php
// Start session to manage user login state
session_start();

include('connection.php');

// Check if user is already logged in, redirect to dashboard if true
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to validate user credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Valid credentials, set session variables
        $_SESSION['username'] = $username;
        // Redirect to dashboard or another page
        header("Location: dashboard.php");
        exit;
    } else {
        // Invalid credentials
        $login_error = "Invalid us  username or password";
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
</head>
<body class="d-flex justify-content-center align-items-center flex-column" style="height: 100vh">
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="width: 300px">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required class="form-control"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required class="form-control"><br><br>
        <input type="submit" value="Login" class="w-100 btn btn-primary">
    </form>
    <?php
    if (isset($login_error)) {
        echo '<p style="color: red;">' . $login_error . '</p>';
    }
    ?>

    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>
</html>
