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
    
<?php
session_start();
$agent_id = $_SESSION['agent_id'];


// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Your database connection and query to fetch the old password from agent_details table
    // Replace this with your actual database connection and query
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "database1"; 

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check if the old password matches the one in the database
    $query = "SELECT password FROM agent_details WHERE agent_id = $agent_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $storedPassword = $row['password'];

    if ($oldPassword ==  $storedPassword) {
        // Check if new and confirm passwords match
        if ($newPassword === $confirmPassword) {
            // Update the password in the database
            $updatedPassword = $newPassword;
            $updateQuery = "UPDATE agent_details SET password = '$updatedPassword' WHERE agent_details.agent_id = $agent_id";
            mysqli_query($conn, $updateQuery);
            
            $successMessage = "Password updated successfully!";
        } else {
            $errorMessage = "New and confirm passwords do not match.";
        }
    } else {
        $errorMessage = "Incorrect old password.";
    }

    mysqli_close($conn);
}
?>
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
                <h1>Reset Password</h1>
                   
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
<a href="Agent-Dashboard.php" class="waves-effect">
    <i class="feather-airplay"></i><span class="badge badge-pill badge-primary float-right"></span>
    <span>Dashboard</span>
</a>
</li>

<li>
<a href="AgentProfile.php" class="waves-effect">
    <i class="fas fa-user-circle"></i><span>View Profile</span>
</a>
</li>

<li>
<a href="Addclient.php" class="waves-effect">
    <i class="fas fa-user-plus"></i><span>Add Clients</span>
</a>
</li>

<li>
<a href="Addpolicy.php" class="waves-effect">
    <i class="fas fa-file-alt"></i><span>Add Policy</span>
</a>
</li>

<li>
<a href="Renewpolicy.php" class="waves-effect">
    <i class="fas fa-edit"></i><span>Renew Policy</span>
</a>
</li>
<li>
    <a href="SentPassword.php" class="waves-effect">
        <i class="fas fa-envelope"></i><span>Sent Password to client</span>
    </a>
</li>
<li>
<a href="Client&Policystable.php" class="waves-effect">
    <i class="fas fa-users"></i><span>View Clients & Policies</span>
</a>
</li>

<li>
<a href="AgentResetPassword.php" class="waves-effect">
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

                                
                               
<form class="needs-validation" method="post"  novalidate>
    <div class="form-group">
        <label for="oldPassword">Old Password</label>
        <input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="Enter old password" required>
    </div>
    <div class="form-group">
        <label for="newPassword">New Password</label>
        <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Enter new password" required>
    </div>
    <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm new password" required>
    </div>
    <?php if (isset($errorMessage)) : ?>
        <p class="text-danger"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <?php if (isset($successMessage)) : ?>
        <p class="text-success"><?php echo $successMessage; ?></p>
    <?php endif; ?>
    <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">Reset Password</button>
</form>

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