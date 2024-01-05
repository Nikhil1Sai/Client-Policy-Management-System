<?php


$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "database1"; 


$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if (isset($_POST['remainder_id'])) {
    $remainder_id = $_POST['remainder_id'];
    
    // Perform the deletion query here
    $delete_query = "DELETE FROM remainder_table WHERE remainder_id = '$remainder_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo "success"; // Send a success response
    } else {
        echo "error"; // Send an error response
    }
}
?>
