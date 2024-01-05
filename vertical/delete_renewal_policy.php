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

if (isset($_GET['renewal_policy_id'])) {
    $Renewal_policy_id = $_GET['renewal_policy_id'];

    // Perform the deletion in the database
    $delete_queryforrenewal = "DELETE FROM Renewal_policies WHERE Renewal_policy_id = $Renewal_policy_id";

    if (mysqli_query($conn, $delete_queryforrenewal)) {
        // Policy deleted successfully
        $success_message = "Renewal Policy deleted successfully.";
        header("Location: Client&Policystable.php?success_message=" . urlencode($success_message));
    } else {
        // Error occurred during deletion
        $error_message = "Error deleting policy.";
        header("Location: Client&Policystable.php?error_message=" . urlencode($error_message));
    }
} else {
    echo "Invalid request.";
}
?>
