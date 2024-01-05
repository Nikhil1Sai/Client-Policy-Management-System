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
$client_id = $_SESSION['client_id'] ;
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
                <h1>Profile</h1>
                   
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
<!-- Sidebar -->
<!-- Logout Button -->
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
                                <h3 class="mb-0 font-size-18">Your Details</h3>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">View Profile</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>     
                    <!-- end page title -->

 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">You can edit your information and Save Changes</h4>
                <form class="needs-validation" novalidate method="POST">
                                    <?php
                                    $db_host = "localhost";
                                    $db_username = "root";
                                    $db_password = "";
                                    $db_name = "database1";

                                    // Create connection
                                    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

                                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                        $client_name = $_POST['client_name'];
                                        $email = $_POST['email'];
                                        $mobile = $_POST['mobile'];
                                        $mobile1 = $_POST['mobile1'];
                                        $whatsapp = $_POST['whatsapp'];
                                        $address = $_POST['address'];
                                        $city = $_POST['city'];
                                        $state = $_POST['state'];

                                        // Check if the updated email already exists in the database (excluding the current client)
                                        $email_check_query = "SELECT * FROM client_details WHERE email = '$email' AND client_id != $client_id";
                                        $email_check_result = mysqli_query($conn, $email_check_query);

                                        if (mysqli_num_rows($email_check_result) > 0) {
                                            echo '<div class="alert alert-danger mt-3" role="alert">';
                                            echo 'Email already exists. Please choose another one.';
                                            echo '</div>';
                                        } else {
                                            // Update the client details in the database
                                            $update_query = "UPDATE client_details SET client_name = '$client_name', email = '$email', mobile = '$mobile', mobile1 = '$mobile1', whatsapp = '$whatsapp', address = '$address', city = '$city', state = '$state' WHERE client_id = $client_id";
                                            $update_result = mysqli_query($conn, $update_query);

                                            if ($update_result) {
                                                echo '<div class="alert alert-success mt-3" role="alert">';
                                                echo 'Client details updated successfully';
                                                echo '</div>';
                                            } else {
                                                echo '<div class="alert alert-danger mt-3" role="alert">';
                                                echo 'Failed to update client details';
                                                echo '</div>';
                                            }
                                        }
                                    }

                                    // Fetch and display client details from database
                                    $query = "SELECT client_name, email, mobile, mobile1, whatsapp, address, city, state FROM client_details WHERE client_id = $client_id";
                                    $result = mysqli_query($conn, $query);
                                    $client_details = mysqli_fetch_assoc($result);
                                    ?>

                                    <!-- Display client details in input fields -->
                                    Name: <input type="text" class="form-control" name="client_name" value="<?php echo $client_details['client_name']; ?>" required><br>
                                    Email: <input type="email" class="form-control" name="email" value="<?php echo $client_details['email']; ?>" required><br>
                                    Mobile Number: <input type="text" class="form-control" name="mobile" value="<?php echo $client_details['mobile']; ?>" required><br>
                                    Alternative Mobile Number: <input type="text" class="form-control" name="mobile1" value="<?php echo $client_details['mobile1']; ?>"><br>
                                    WhatsApp Number: <input type="text" class="form-control" name="whatsapp" value="<?php echo $client_details['whatsapp']; ?>"><br>
                                    Address: <input type="text" class="form-control" name="address" value="<?php echo $client_details['address']; ?>" required><br>
                                    City: <input type="text" class="form-control" name="city" value="<?php echo $client_details['city']; ?>" required><br>
                                    State: <input type="text" class="form-control" name="state" value="<?php echo $client_details['state']; ?>" required><br>

                                    <!-- Save Details Button -->
                                    <button class="btn btn-primary waves-effect waves-light" id="saveDetailsBtn">Save Changes</button>

                                    <script>
                                        // JavaScript to toggle between Edit and Update buttons
                                        document.getElementById('saveDetailsBtn').addEventListener('click', function() {
                                            var inputs = document.querySelectorAll('input[type="text"], input[type="email"]');
                                                for (var i = 0; i < inputs.length; i++) {
                                                    inputs[i].removeAttribute('readonly');
                                                }
                                        });
                                    </script>
                </form>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
<!-- end row-->

<!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2019 © Xacton.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Design & Develop by Kohil Media
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