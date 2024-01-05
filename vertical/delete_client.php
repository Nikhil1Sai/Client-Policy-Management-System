<?php
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

if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];

    // Perform the deletion in the database
    $delete_query = "DELETE FROM client_details WHERE client_id = $client_id";

    if (mysqli_query($conn, $delete_query)) {
        // Client deleted successfully
        $success_message = "Client deleted successfully.";
        header("Location: Client&Policystable.php?success_message=" . urlencode($success_message));
    } else {
        // Error occurred during deletion
        $error_message = "Error deleting client.";
        header("Location: Client&Policystable.php?error_message=" . urlencode($error_message));
    }
} else {
    echo "Invalid request.";
}
?>
