<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: admin.php");
    exit;
}

// Logout functionality
if (isset($_POST['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        *{
            box-sizing: border-box;
            margin: 0px; 
            padding: 0px;
        }    
    </style>
</head>
<body>
    <div class="d-flex justify-content-between p-2 bg-dark text-white align-items-center"> 
            <h5>Welcome, <?php echo $_SESSION['username']; ?></h5>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="submit" name="logout" value="Logout" class="btn btn-primary">
            </form>
</div>

<div class=" m-1 table-responsive">
    <table id="example" class="table table-bordered table-hover bg-secondary is-striped">
        <thead class="">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Message</th>
                <th>Date</th>
                <th>Call Client</th>
                <th>Message Client</th>
            </tr>
        </thead>
        <tbody class="m-3">
        </tbody>
    </table>
</div>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "ajax": {
            "url": "api.php", // Endpoint to fetch data
            "dataSrc": "data" // Specify the property name in JSON response containing the data array
        },
        "columns": [
            { "data": "name" },
            { "data": "email" },
            { "data": "phone_number" },
            { "data": "message" },
            { "data": "date"},
            { "data": "phone_number", 
                "render": function(data, type, row){
                 return '<a class="btn btn-primary" href="tel:' + data + '">' + "Call Client" + '</a>';
                }
            },
            {
                "data": "phone_number", 
                "render": function(data, type, row) {
                    var message = "Hello " + row.name + ", thank you for your interest in properties! \n\nYour Query: " + row.message + "\n\nWe're delighted to assist you. Please find more details attached.";
                    var imageLink = window.location.origin + '/property_image.jpg'; 
                    var encodedMessage = encodeURIComponent(message);
                    var encodedImageLink = encodeURIComponent(imageLink);
                    var whatsappLink = 'https://wa.me/' + data + '?text=' + encodedMessage + '%0A%0A' + encodedImageLink;
                    return '<a class="btn btn-primary" href="' + whatsappLink + '" target="_blank">Message Us</a>';
}
            }
        ]
    });
});
</script>

</body>
</html>

