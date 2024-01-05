<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['sentremainder'])) {
    
    $client_id = $_POST['selected_client_id'];

    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "database1"; 

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    $query = "SELECT email, password, agent_id FROM client_details WHERE client_id = '$client_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $email = $row['email'];
    $password = $row['password'];
    
    $agent_id = $row['agent_id'];
    
    // Fetch agent's email from agent_details table
    $agent_query = "SELECT email FROM agent_details WHERE agent_id = '$agent_id'";
    $agent_result = mysqli_query($conn, $agent_query);
    $agent_row = mysqli_fetch_assoc($agent_result);
    $agent_email = $agent_row['email'];

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'patnamnikhilsai@gmail.com';
        $mail->Password   = 'tcdgergxeeruvzcp';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom($agent_email, 'Agent');
        $mail->addAddress($email, 'Client');

        $mail->isHTML(true);
        $mail->Subject = 'Your Password';
        $mail->Body    = "Password: $password";

        if ($mail->send()) {
            // Email sent successfully
            $_SESSION['email_sent'] = true;
        } else {
            // Email sending failed
            $_SESSION['email_sent'] = false;
        }
    } catch (Exception $e) {
        $_SESSION['email_sent'] = false;
    }

    mysqli_close($conn);
    
    // Redirect back to SentPassword.php
    header("Location: SentPassword.php");
    exit();
}
?>
