<?php
// Start a session to store user data
session_start();

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

$error_message = ''; // Initialize the error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user's email and password from the form
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    // Validate email format
    if (!isValidEmail($email)) {
        $error_message = "Invalid email format.";
    } else {

        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "database1"; 

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        // Check for database connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize user input
        $email = sanitizeInput($email);
        $password = sanitizeInput($password);

        if (isset($_POST['agent_login'])) {
            // Query to fetch agent record based on the provided email
            $sql = "SELECT * FROM agent_details WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows === 1) {
                // If agent record found, check the password
                $row = $result->fetch_assoc();
                $storedPassword = $row['password'];

                // Verify the provided password against the stored hashed password
                if ($password == $storedPassword) {
                    // Passwords match - login successful
                    // If agent record found, set session data and redirect to agent dashboard
                    $_SESSION['agent_id'] = $row['agent_id'];
                    $_SESSION['user_id'] = $row['email']; 
                    $_SESSION['user_type'] = 'agent'; // To differentiate agent from client
                    
                    header("Location: Agent-Dashboard.php");
                    // header("Location: AddClient.php");
                    // header("Location: SentPassword.php");

                    exit; // Ensure the script stops here to prevent further execution
                } else {
                    // Passwords do not match
                    $error_message = "Invalid password.";
                }
            } else {
                // Agent not found in the database
                $error_message = "Agent not found.";
            }
        } elseif (isset($_POST['client_login'])) {
            // Query to fetch client record based on the provided email
            $sql = "SELECT * FROM client_details WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows === 1) {
                // If client record found, check the password
                $row = $result->fetch_assoc();
                $storedPassword = $row['password'];

                // Verify the provided password against the stored hashed password
                if ($password == $storedPassword) {
                    // Passwords match - login successful
                    // If client record found, set session data and redirect to client dashboard
                    $_SESSION['client_id'] = $row['client_id'];
                    $_SESSION['user_id'] = $row['email']; 
                    $_SESSION['user_name'] = 'client_name';
                    $_SESSION['user_type'] = 'client'; // To differentiate agent from client
                    
                    header("Location: Client-dashboard.php");
                    // header("Location: index.html");
                    // header("Location: AddClient.php");

                    exit; // Ensure the script stops here to prevent further execution
                } else {
                    // Passwords do not match
                    $error_message = "Invalid password.";
                }
            } else {
                // Client not found in the database
                $error_message = "Client not found.";
            }
        }

        // Close the database connection
        $conn->close();
    }

    // If there is an error, redirect back to pages-login.html with the error message in the URL
    if ($error_message) {
        header("Location: pages-login.php?error=" . urlencode($error_message));
        exit;
    }
}
?>
