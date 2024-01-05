<?php
// Assuming you have a database connection established
// Replace this with your actual database connection and query
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "database1"; 

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
session_start();
// Check if the "Check agent details" button is clicked
if (isset($_POST['check_agent_details'])) {
    // Assuming the client_id is stored in a session variable
   
    if (isset($_SESSION['client_id'])) {
        $client_id = $_SESSION['client_id'];

        // Query to retrieve agent_id from client_details table
        $clientQuery = "SELECT agent_id FROM client_details WHERE client_id = '$client_id'";
        $clientResult = mysqli_query($conn, $clientQuery);

        if ($clientResult) {
            $clientRow = mysqli_fetch_assoc($clientResult);
            $agent_id = $clientRow['agent_id'];

            // Query to retrieve agent details from agent_details table
            $agentQuery = "SELECT first_name, last_name, email FROM agent_details WHERE agent_id = '$agent_id'";
            $agentResult = mysqli_query($conn, $agentQuery);

            if ($agentResult) {
                $agentRow = mysqli_fetch_assoc($agentResult);
                $agentName = $agentRow['first_name'] . ' ' . $agentRow['last_name'];
                $agentEmail = $agentRow['email'];
            } else {
                $errorMessage = "Something went wrong while retrieving agent details.";
            }
        } else {
            $errorMessage = "Something went wrong while retrieving client details.";
        }
    } else {
        $errorMessage = "Client ID not set.";
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
            
                

               <div class="d-flex align-items-center"> 
                <h1>Your Agent Details</h1>
                   
                </div>     
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                
                               
        <form class="needs-validation" method='post' novalidate>
            

            <button class="btn btn-primary waves-effect waves-light" type="submit" name="check_agent_details">Check Agent Details</button>
        </form>

        <?php if (isset($agentName) && isset($agentEmail)) { ?>
            <div class="agent-details">
                <br>
                <h4><b>Name :</b> <?php echo $agentName; ?></h4>
                <h4><b>Email :</b> <?php echo $agentEmail; ?></h4>
            </div>
        <?php } elseif (isset($errorMessage)) { ?>
            <div class="error-message">
                <?php echo $errorMessage; ?>
            </div>
        <?php } ?>


                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2019 © Xacton.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Design & Develop by Kohli-Media
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/simplebar.min.js"></script>

    <!-- Validation custom js-->
    <script src="assets/pages/validation-demo.js"></script>

    <!-- App js -->
    <script src="assets/js/theme.js"></script>

</body>

</html>