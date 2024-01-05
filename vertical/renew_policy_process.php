<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "database1";

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['renewPolicyButton'])) {
    // Get the form data
    $clientId = $_POST['client_id'];
    $policyId = $_POST['policy_id'];
    $policyName = $_POST['policy_name'];
    $policyPremium = $_POST['policy_premium'];
    $policySum = $_POST['policy_sum'];
    $policyType = $_POST['policy_type'];
    $installmentType = $_POST['installment_type'];
    $policyStartDate = $_POST['policy_start_date'];
    $policyExpDate = $_POST['policy_Exp_date'];
    $policyDays = $_POST['policy_days'];

    // Handle the policy document upload
    $policyDocument = ''; // Initialize an empty variable for the document path
    if ($_FILES['policy_document']['error'] === 0) {
        $policyDocumentFileName = $_FILES['policy_document']['name'];
        $policyDocumentTmpName = $_FILES['policy_document']['tmp_name'];
        $policyDocumentPath = 'PolicyDocs/' . $policyDocumentFileName; // You can customize the path
        if (move_uploaded_file($policyDocumentTmpName, $policyDocumentPath)) {
            // File uploaded successfully, set the document path
            $policyDocument = $policyDocumentPath;
        } else {
            // File upload failed
            header("Location: RenewPolicy.php?status=error&message=File upload failed.");
            exit;
        }
    }

    // Perform the database insert into Renewal_Policies
    $sql = "INSERT INTO Renewal_Policies (policy_id, Renewal_policy_name, Renewal_policy_premium, Renewal_policy_sum, Renewal_policy_type, Renewal_Installment_Type, Renewal_policy_start_date, Renewal_policy_days, Renewal_policy_Exp_date, Renewal_policy_document) 
            VALUES ('$policyId', '$policyName', '$policyPremium', '$policySum', '$policyType', '$installmentType', '$policyStartDate', '$policyDays', '$policyExpDate', '$policyDocument')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Policy details added successfully, you can redirect to a success page
        header("Location: RenewPolicy.php?status=success&policy_id=$policyId");
        
    } else {
        // Policy details insertion failed, redirect to an error page
        header("Location: RenewPolicy.php?status=error&message=Policy details insertion failed.");
    }

    // Close your database connection here
} else {
    echo "Error: The renewPolicyButton was not set in the POST request.";
}
?>
