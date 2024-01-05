<?php
// Database connection details
$db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "database1";

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['policy_id'])) {
    $policy_id = $_GET['policy_id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM policies_table WHERE policy_id = ?");
    $stmt->bind_param("i", $policy_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Return policy details as JSON
        echo json_encode($row);
    } else {
        echo json_encode(array("error" => "Policy not found"));
    }

    $stmt->close();
} else {
    echo json_encode(array("error" => "Policy ID not provided"));
}

// Close the database connection
$conn->close();
?>
