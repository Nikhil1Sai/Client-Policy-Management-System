<?php
// get_policies.php
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["clientId"])) {
    $clientId = $_GET["clientId"];

    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "database1";

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    $query = "SELECT policy_id, policy_name FROM policies_table WHERE client_id = '$clientId'";
    $result = mysqli_query($conn, $query);

    $policies = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $policies[] = $row;
    }

    mysqli_close($conn);

    echo json_encode($policies);
} else {
    // Handle invalid requests here
    echo json_encode(array("error" => "Invalid request"));
}
?>
