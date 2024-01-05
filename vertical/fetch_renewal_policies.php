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

if (isset($_GET['policyId'])) {
    $policyId = $_GET['policyId'];

    // Query to retrieve renewal policies based on the provided policyId
    $query = "SELECT * FROM renewal_policies WHERE policy_id = $policyId";

    $result = mysqli_query($conn, $query);

    $renewalPolicies = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $renewalPolicies[] = [
                'Renewal_policy_id' => $row['Renewal_policy_id'],
                'Renewal_policy_name' => $row['Renewal_policy_name'],
                'Renewal_policy_premium' => $row['Renewal_policy_premium'],
                'Renewal_policy_sum' => $row['Renewal_policy_sum'],
                'Renewal_policy_type' => $row['Renewal_policy_type'],
                'Renewal_Installment_Type' => $row['Renewal_Installment_Type'],
                'Renewal_policy_start_date' => $row['Renewal_policy_start_date'],
                'Renewal_policy_days' => $row['Renewal_policy_days'],
                'Renewal_policy_Exp_date' => $row['Renewal_policy_Exp_date'],
                'Renewal_policy_document' => $row['Renewal_policy_document'],
            ];
        }
    }

    // Encode the renewal policies data as JSON and return it
    echo json_encode($renewalPolicies);
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
