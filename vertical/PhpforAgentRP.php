<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
// Assuming you have a database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "database1"; 

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email entered by the user
    $email = $_POST["email"];

    // Prepare and execute a query
    $sql = "SELECT password FROM agent_details WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($passwordHash);

    if ($stmt->fetch()) {
        // Password found in the database
        $passwordFromDB = $passwordHash;

        // Email Process
        $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'patnamnikhilsai@gmail.com';
        $mail->Password   = 'tcdgergxeeruvzcp';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('patnamnikhilsai@gmail.com', 'Nikhil');
        $mail->addAddress($email, 'Client');

        $mail->isHTML(true);
        $mail->Subject = 'Your Password';
        $mail->Body    = "Password: $passwordFromDB";

        if ($mail->send()) {
            // Email sent successfully
            // Redirect back to the first page with success message
            header("Location: AgentRecoveryPassword.php?success=email_found");
            
        } else {
            // Email sending failed
            // // Redirect back to the first page with success message
            // header("Location: AgentRecoveryPassword.php?success=email_found");
            // $_SESSION['email_sent'] = false;
            echo "mail not sent";
        }
    } catch (Exception $e) {
        echo "mail not sent expection";
    }

        // Close the statement
        $stmt->close();

        // // Redirect back to the first page with success message
        // header("Location: AgentRecoveryPassword.php?success=email_found");
        // exit();
    } else {
        // Email not found
        $stmt->close();
        header("Location: AgentRecoveryPassword.php?error=email_not_found");
        exit();
    }
}

// Close the connection
$conn->close();
?>
