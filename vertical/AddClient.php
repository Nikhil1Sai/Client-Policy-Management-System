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
$agent_id = $_SESSION['agent_id'] ;
$emailError="";
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
                <h1>Add the Client</h1>
                   
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

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Validation</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                        <li class="breadcrumb-item active">Validation</li>
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

                <h4 class="card-title">Client Details</h4>
                <form class="needs-validation" novalidate method="POST" action="Phpforaddclient.php">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Client Name</label>
                            <input type="text" class="form-control" id="validationCustom01" placeholder="Client Name" name="client_name" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
<div class="col-md-4 mb-3">
    <label for="validationCustom02">Email</label>
    <input type="email" class="form-control <?php echo isset($_GET['emailError']) ? 'is-invalid' : ''; ?>" id="validationCustom02" placeholder="Email" name="email" required>
    <?php if (isset($_GET['emailError'])): ?>
        <div class="invalid-feedback">
            <?php echo urldecode($_GET['emailError']); ?>
        </div>
    <?php endif; ?>
</div>

                        <div class="col-md-4 mb-3">
                            <label for="validationCustomUsername">Mobile Number</label>
                            <input type="text" class="form-control" id="validationCustomUsername" placeholder="Mobile Number" name="mobile" required>
                            <div class="invalid-feedback">
                                Please provide a valid mobile number.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom03">Alternative Number</label>
                            <input type="text" class="form-control" id="validationCustom03" name="mobile1" placeholder="Alternative Number" >
                            <div class="invalid-feedback">
                                Please provide a valid alternative number.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom04">WhatsApp Number</label>
                            <input type="text" class="form-control" id="validationCustom04"  name="whatsapp" placeholder="WhatsApp Number" required>
                            <div class="invalid-feedback">
                                Please provide a valid WhatsApp number.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom05">Address</label>
                            <input type="text" class="form-control" id="validationCustom05" name = "address" placeholder="Address" required>
                            <div class="invalid-feedback">
                                Please provide a valid address.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom06">City</label>
                            <input type="text" class="form-control" id="validationCustom06" name="city" placeholder="City" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom07">State</label>
                            <input type="text" class="form-control" id="validationCustom07" name="state" placeholder="State" required>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom08">Zip</label>
                            <input type="text" class="form-control" id="validationCustom08" placeholder="Zip" name="zip" required>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom09">Password</label>
                            <input type="password" class="form-control" id="validationCustom09" name="password" placeholder="Password" required>
                            <div class="invalid-feedback">
                                Please provide a valid password.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox form-check">
                            <input type="checkbox" class="custom-control-input" id="invalidCheck" required>
                            <label class="custom-control-label" for="invalidCheck">Agree to terms and conditions</label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary waves-effect waves-light" type="submit">Create Client</button>
<?php

if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        $client_id = $_GET['client_id'];
        echo '<div class="alert alert-success mt-3" role="alert">';
        echo 'Client added successfully! Client ID: ' . $client_id;
        echo ' with agent id: ' . $agent_id;
        echo '</div>';
    } elseif ($_GET['status'] === 'error') {
        echo '<div class="alert alert-danger mt-3" role="alert">';
        echo 'Client not added. Please try again.';
        echo '</div>';
    }
}
?>
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