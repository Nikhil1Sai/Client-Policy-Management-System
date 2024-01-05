<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $agent_id = $_SESSION['agent_id'];

    // Establish a database connection (you need to provide your database connection details here)
    $db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "database1";

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);


    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the email from the form
    $email = $_POST['email'];

    // Check if the email already exists in the database
    $sql = "SELECT * FROM client_details WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email already exists, set an error message
        $emailError = "Email already exists.";
        header("Location: AddClient.php?emailError=" . urlencode($emailError));
        exit();
    } else {
        // Email doesn't exist, insert the client into the database
        // You should sanitize and validate other form fields before inserting them into the database
        // Insert the client details into the client_details table
        $client_name = $_POST['client_name'];
        $mobile = $_POST['mobile'];
        $mobile1 = $_POST['mobile1'];
        $whatsapp = $_POST['whatsapp'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $password = $_POST['password'];

        $insert_sql = "INSERT INTO client_details (agent_id, client_name, email, mobile, mobile1, whatsapp, address, city, state, zip, password)
                       VALUES ('$agent_id', '$client_name', '$email', '$mobile', '$mobile1', '$whatsapp', '$address', '$city', '$state', '$zip', '$password')";

        if ($conn->query($insert_sql) === TRUE) {
            header("Location: AddClient.php?status=success&client_id=" . $conn->insert_id);
            exit();
        } else {
            header("Location: AddClient.php?status=error");
            exit();
        }
    }

    // Close the database connection
    $conn->close();
}
?>
