<?php
session_start();

// Check if the agent is logged in
if (!isset($_SESSION['agent_id'])) {
    header("Location: pages-login.php"); // Redirect to the login page if not logged in
    exit();
}

// Replace with your database credentials
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "database1";

// Create a new MySQLi connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve agent_id from the session
$agent_id = $_SESSION['agent_id'];

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_POST['client_id'];
    $policy_name = $_POST['policy_name'];
    $policy_premium = $_POST['policy_premium'];
    $policy_sum = $_POST['policy_sum'];
    $policy_type = $_POST['policy_type'];
    $installment_type = $_POST['installment_type'];
    $policy_start_date = $_POST['policy_start_date'];
    $policy_expiry_date = $_POST['policy_expiry_date'];
    $policy_days=$_POST['policy_duration'];

    // Handle file upload (you may need to adjust the directory path)
    $target_dir = "PolicyDocs/"; // Specify your upload directory
    $target_file = $target_dir . basename($_FILES["policy_document"]["name"]);

    if (move_uploaded_file($_FILES["policy_document"]["tmp_name"], $target_file)) {
        // File uploaded successfully, insert data into the database
        // $stmt = $conn->prepare("INSERT INTO policies_table (client_id, policy_name, policy_premium, policy_sum, policy_type, installment_type, policy_start_date, policy_Exp_date, policy_days, policy_document) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        // $stmt->bind_param("isdsdsssss", $client_id, $policy_name, $policy_premium, $policy_sum, $policy_type, $installment_type, $policy_start_date, $policy_expiry_date, $policy_days, $target_file);
        
        $stmt = $conn->prepare("INSERT INTO policies_table (client_id, policy_name, policy_premium, policy_sum, policy_type, installment_type, policy_start_date, policy_Exp_date, policy_days, policy_document) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("isdsdsssss", $client_id, $policy_name, $policy_premium, $policy_sum, $policy_type, $installment_type, $policy_start_date, $policy_expiry_date, $policy_days, $target_file);
    


        if ($stmt->execute()) {
            // Policy added successfully
            $policy_id = $conn->insert_id;
            header("Location: addpolicy.php?status=success&policy_id=$policy_id");
            exit();
        } else {
            // Policy not added
            header("Location: addpolicy.php?status=error");
            exit();
        }
    } else {
        // File upload failed
        header("Location: addpolicy.php?status=file_error");
        exit();
    }
}
// ... (previous code)

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $client_id = $_POST['client_id'];
//     $policy_name = $_POST['policy_name'];
//     $policy_premium = $_POST['policy_premium'];
//     $policy_sum = $_POST['policy_sum'];
//     $policy_type = $_POST['policy_type']; // Retrieve policy_type from the form

//     // ... (other form inputs)

//     // SQL query with placeholders
//     $stmt = $conn->prepare("INSERT INTO policies_table (client_id, policy_name, policy_premium, policy_sum, policy_type, installment_type, policy_start_date, policy_Exp_date, policy_days, policy_document) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

//     // Bind parameters
//     $stmt->bind_param("isdsdsssss", $client_id, $policy_name, $policy_premium, $policy_sum, $policy_type, $installment_type, $policy_start_date, $policy_expiry_date, $policy_days, $target_file);

//     // Execute the query
//     if ($stmt->execute()) {
//         // Policy added successfully
//         $policy_id = $conn->insert_id;
//         header("Location: addpolicy.php?status=success&policy_id=$policy_id");
//         exit();
//     } else {
//         // Policy not added
//         header("Location: addpolicy.php?status=error");
//         exit();
//     }
// }

// ... (rest of your code)

?>
