<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "database1";

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if (isset($_GET['policy_id'])) {
    $policy_id = $_GET['policy_id'];

    // Delete related renewal policies first
    $delete_queryforrenewal = "DELETE FROM Renewal_policies WHERE policy_id = $policy_id";

    if (mysqli_query($conn, $delete_queryforrenewal)) {
        // Related renewal policies deleted successfully, now delete the policy
        $delete_query = "DELETE FROM policies_table WHERE policy_id = $policy_id";

        if (mysqli_query($conn, $delete_query)) {
            // Policy deleted successfully
            $success_message = "Policy deleted successfully.";
            header("Location: Client&Policystable.php?success_message=" . urlencode($success_message));
        } else {
            // Error occurred during policy deletion
            $error_message = "Error deleting policy.";
            header("Location: Client&Policystable.php?error_message=" . urlencode($error_message));
        }
    } else {
        // Error occurred during deletion of related renewal policies
        $error_message = "Error deleting related renewal policies.";
        header("Location: Client&Policystable.php?error_message=" . urlencode($error_message));
    }
} else {
    echo "Invalid request.";
}

?>
