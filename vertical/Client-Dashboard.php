<?php
session_start();
$client_id=$_SESSION['client_id'];

$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "database1"; 


$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if(isset($_SESSION['client_id'])) {
    // SQL query to count total clients for the agent
    $sql = "SELECT COUNT(*) as total_policies FROM policies_table WHERE client_id = $client_id";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();

        // Display the total number of clients
        $total_policies = $row['total_policies'];
    } else {
        $total_clients = 0;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Xacton - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/theme.min.css" rel="stylesheet" type="text/css" />
<style>
    .message-box {
        border: 1px solid #ccc;
        padding: 10px;
        max-height: 300px;
        overflow-y: auto;
        background-color: #f9f9f9;
    }

    .message-box ul {
        list-style-type: none;
        padding: 0;
    }

    .message-box li {
        margin-bottom: 5px;
        padding: 5px;
        border: 1px solid #ddd;
        background-color: #fff;
    }

    .message-box p {
        margin: 0;
    }
</style>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

<header id="page-topbar">
    <div class="navbar-header">    
    <div class="d-flex align-items-left">
                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
    </div>                
        <div class="d-flex align-items-center justify-content-end flex-grow-1"> 
            <!-- <div class="dropdown d-inline-block ml-2"> -->
                <a href="ClientProfile.php" class="btn header-item waves-effect" id="page-header-user-dropdown">
                    <i class="fas fa-user-circle fa-2x"></i> <!-- Larger profile icon -->
                    <p>View Profile</p>
                </a>
            <!-- </div> -->
        </div>
    </div>
</header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <div class="navbar-brand-box">
                    <a  class="logo">
                        <i class="mdi mdi-alpha-x-circle"></i>
                        <span>
                            Xacton
                        </span>
                    </a>
                </div>

<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

        <li>
            <a href="Client-Dashboard.php" class="waves-effect">
                <i class="feather-airplay"></i><span class="badge badge-pill badge-primary float-right"></span>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="ClientProfile.php" class="waves-effect">
                <i class="fas fa-user-circle"></i><span>View Profile</span>
            </a>
        </li>
        <li>
            <a href="Agent_details_forClient.php" class="waves-effect">
                <i class="fas fa-user-circle"></i><span>Agent Details</span>
            </a>
        </li> 
        
        <li>
            <a href="ViewPolicy.php" class="waves-effect">
                <i class="fas fa-users"></i><span>View Policies</span>
            </a>
        </li>
        
        <li>
            <a href="ClientResetPassword.php" class="waves-effect">
                <i class="fas fa-key"></i><span>Reset Password</span>
            </a>
        </li>
        <li>
            <a href="logout.php" class="waves-effect">
                <i class="fas fa-sign-out-alt"></i><span>Logout</span>
            </a>
</li>
    </ul>
</div>

                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Xacton</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-primary border-primary">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h4 class="card-title mb-0 text-white">Total Policies:</h4>
                                    </div>
                                    <div class="row d-flex align-items-center mb-4">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0 text-white">
                                                <?php
                                                echo "$total_policies";
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                    </div>
                    <!-- end row -->

                    
                  


                    <div class="row">
                    <div class="col-lg-8">
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3 font-weight-bold text-uppercase">Reminder Notifications</h5>
            <div id="accordion2" style="max-height: 400px; overflow-y: auto;">
                <?php
                // Assuming you have the $conn variable for database connection
                $query = "SELECT remainder_id, subject, textarea FROM remainder_table ORDER BY remainder_id DESC";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $remainder_id = $row['remainder_id'];
                        $subject = $row['subject'];
                        $textarea = $row['textarea'];

                        echo '<div class="card mb-1" id="notification' . $remainder_id . '">';
                        echo '<div class="card-header bg-light border-bottom-0 p-3" id="heading' . $count . '">';
                        echo '<h5 class="m-0 font-size-16">';
                        echo '<a href="#" class="text-dark" data-toggle="collapse" data-target="#collapse' . $count . '" aria-expanded="false" aria-controls="collapse' . $count . '">';
                        echo '<i class="fas fa-bell mr-2"></i>' . $subject; // Display subject with notification icon
                        echo '</a>';
                        echo '<a href="#" class="text-danger float-right delete-icon" title="Remove" onclick="removeNotification(' . $remainder_id . ')"><i class="fas fa-times"></i></a>'; // Remove symbol with JavaScript call
                        echo '</h5>';
                        echo '</div>';
                        echo '<div id="collapse' . $count . '" class="collapse" aria-labelledby="heading' . $count . '" data-parent="#accordion2">';
                        echo '<div class="card-body text-muted pt-1">';
                        echo $textarea; // Display textarea content
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        $count++;
                    }
                } else {
                    echo '<p>No reminder notifications found.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript function to remove notification using AJAX
    function removeNotification(remainderId) {
        if (confirm("Are you sure you want to remove this notification?")) {
            // Send an AJAX request to delete the notification
            $.ajax({
                type: "POST",
                url: "delete_notification.php", // Replace with the actual URL for your PHP script
                data: { remainder_id: remainderId },
                success: function(response) {
                    if (response === "success") {
                        // Remove the notification element from the page
                        $("#notification" + remainderId).remove();
                    } else {
                        alert("Failed to remove the notification.");
                    }
                },
                error: function() {
                    alert("An error occurred while processing the request.");
                }
            });
        }
    }
</script>




            </div>










    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/simplebar.min.js"></script>

    <!-- App js -->
    <script src="assets/js/theme.js"></script>
</body>

</html>